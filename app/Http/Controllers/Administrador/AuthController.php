<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Administrador\User;
use App\Models\Administrador\DatosEmpresa;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\RegistroExitosoMail;

class AuthController extends Controller
{
    private function DatosGeneralesDeLaEmpresa()
    {
        return DatosEmpresa::first()?->toArray() ?? [
            "nombre_empresa" => "Empresa",
            "eslogan_empresa" => "",
            "logo_empresa" => "",
            "descripcion_empresa" => "",
            "icono_derechos" => "bi bi-c-circle",
            "texto_derechos" => "Todos los derechos reservados."
        ];
    }

    // =========================
    // LOGIN VIEW
    // =========================
    public function login()
    {
        return view('administrador.vistas.login_admin', [
            "generales" => $this->DatosGeneralesDeLaEmpresa()
        ]);
    }

    // =========================
    // REGISTER VIEW
    // =========================
    public function register()
    {
        return view('administrador.vistas.registro_admin', [
            "generales" => $this->DatosGeneralesDeLaEmpresa()
        ]);
    }

    // =========================
    // REGISTRO
    // =========================
    public function saveRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admin_usuarios,email',
            'password' => [
                'required',
                'min:8',
                'regex:/[A-Z]/',
                'regex:/[@$!%*?&.#_-]/'
            ],
            'role' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $fotoNombre = null;

        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            $file = $request->file('foto');
            $fotoNombre = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('Imagenes'), $fotoNombre);
        }

        $usuario = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role,
            'foto' => $fotoNombre
        ]);

        try {
            Mail::to($usuario->email)->send(
                new RegistroExitosoMail($usuario, $this->DatosGeneralesDeLaEmpresa())
            );
        } catch (\Exception $e) {
            Log::error("Error Mail: " . $e->getMessage());
        }

        return redirect('/login/admin')->with('success', 'Usuario registrado con éxito.');
    }

    // =========================
    // LOGIN POST
    // =========================
    public function loginPost(Request $request)
    {
        $request->validate([
            'captcha' => 'required'
        ]);

        $captchaUser = trim(strtoupper($request->captcha));
        $captchaSession = session('captcha_code');

        session()->forget('captcha_code');

        if (!$captchaSession || $captchaUser !== $captchaSession) {
            return back()->with('error', 'Captcha incorrecto.')->withInput();
        }

        $usuario = User::where('email', $request->email)->first();

        if (!$usuario) {
            return back()->with('error', 'El correo no existe.');
        }

        if ($usuario->role !== 'admin') {
            return back()->with('error', 'No tienes permisos de administrador.');
        }

        if (!Hash::check($request->password, $usuario->password)) {
            return back()->with('error', 'Contraseña incorrecta.');
        }

        // =========================
        // SESIÓN CORRECTA ADMIN
        // =========================
        session([
            'admin' => $usuario,
            'last_activity_admin' => time()
        ]);

        return redirect('/dashboard')
            ->with('success', 'Bienvenido ' . $usuario->name);
    }

    // =========================
    // LOGOUT
    // =========================
    public function logout()
    {
        session()->forget(['admin', 'last_activity_admin']);
        session()->flush();

        return redirect('/login/admin');
    }
}