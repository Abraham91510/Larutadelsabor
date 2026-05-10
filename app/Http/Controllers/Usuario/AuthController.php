<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario\Comerciante;
use App\Models\Usuario\Cliente;
use App\Models\Usuario\DatosEmpresa;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\RegistroExitosoMail;

class AuthController extends Controller
{
    // 🟢 DATOS EMPRESA
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

    // 🟢 VISTA LOGIN
    public function login()
    {
        return view('usuario.vistas.login_usuario', [
            "generales" => $this->DatosGeneralesDeLaEmpresa()
        ]);
    }

    // 🟢 VISTA REGISTER
    public function register()
    {
        return view('usuario.vistas.registro_usuario', [
            "generales" => $this->DatosGeneralesDeLaEmpresa()
        ]);
    }

    // 🟢 REGISTRO
    public function saveRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => [
                'required',
                'min:8',
                'regex:/[A-Z]/',
                'regex:/[@$!%*?&.#_-]/'
            ],
            'tipo_usuario' => 'required|in:cliente,comerciante',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // 📸 FOTO
        $fotoNombre = null;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fotoNombre = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('Imagenes'), $fotoNombre);
        }

        // 🟢 CLIENTE
        if ($request->tipo_usuario == "cliente") {

            if (Cliente::where('email', $request->email)->exists()) {
                return back()->with('error', 'El correo ya existe.');
            }

            $user = Cliente::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'foto' => $fotoNombre
            ]);
        }

        // 🟢 COMERCIANTE
        else {

            if (Comerciante::where('email', $request->email)->exists()) {
                return back()->with('error', 'El correo ya existe.');
            }

            $user = Comerciante::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'foto' => $fotoNombre
            ]);
        }

        // 📧 EMAIL
        try {
            Mail::to($user->email)->send(
                new RegistroExitosoMail(
                    $user,
                    $this->DatosGeneralesDeLaEmpresa()
                )
            );
        } catch (\Exception $e) {
            Log::error("Error Mail: " . $e->getMessage());
        }

        return redirect('/login/usuario')
            ->with('success', 'Usuario registrado con éxito.');
    }

    // 🟢 LOGIN POST
    public function loginPost(Request $request)
    {
        $request->validate([
            'captcha' => 'required',
            'tipo_usuario' => 'required|in:cliente,comerciante'
        ]);

        $captchaUser = trim(strtoupper($request->captcha));
        $captchaSession = session('captcha_code');

        session()->forget('captcha_code');

        if (!$captchaSession || $captchaUser !== $captchaSession) {
            return back()->with('error', 'Captcha incorrecto.')->withInput();
        }

        $tipo = $request->tipo_usuario;

        // 🟢 CLIENTE
        if ($tipo == 'cliente') {

            $user = Cliente::where('email', $request->email)->first();

            if (!$user) {
                return back()->with('error', 'Cliente no existe.');
            }

            if (!Hash::check($request->password, $user->password)) {
                return back()->with('error', 'Contraseña incorrecta.');
            }

            session([
                'user' => $user,
                'tipo_usuario' => 'cliente',
                'last_activity' => time()
            ]);
        }

        // 🟢 COMERCIANTE
        else {

            $user = Comerciante::where('email', $request->email)->first();

            if (!$user) {
                return back()->with('error', 'Comerciante no existe.');
            }

            if (!Hash::check($request->password, $user->password)) {
                return back()->with('error', 'Contraseña incorrecta.');
            }

            session([
                'user' => $user,
                'tipo_usuario' => 'comerciante',
                'last_activity' => time()
            ]);
        }

        return redirect('/plataforma/inicio');
    }

    // 🟢 LOGOUT
    public function logout()
    {
        session()->forget([
            'user',
            'last_activity',
            'tipo_usuario'
        ]);

        session()->flush();

        return redirect('/login/usuario');
    }
}