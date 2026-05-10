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

    // 🟢 LOGIN VIEW
    public function login()
    {
        return view('administrador.vistas.login_admin', [
            "generales" => $this->DatosGeneralesDeLaEmpresa()
        ]);
    }

    // 🟢 REGISTER VIEW
    public function register()
    {
        return view('administrador.vistas.registro_admin', [
            "generales" => $this->DatosGeneralesDeLaEmpresa()
        ]);
    }

    // 🟢 REGISTRO
    // 🟢 REGISTRO CORREGIDO
public function saveRegister(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:admin_users,email',
        'password' => [
            'required',
            'min:8',
            'regex:/[A-Z]/',
            'regex:/[@$!%*?&.#_-]/'
        ],
        'role' => 'required',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
    ], [
        'name.required' => 'El nombre es obligatorio.',
        'email.required' => 'El correo electrónico es obligatorio.',
        'email.unique'   => 'Este correo ya está registrado, intenta con otro.', // Mensaje que faltaba
        'password.required' => 'La contraseña no puede estar vacía.',
        'password.regex' => 'Debe tener mayúscula y símbolo especial.',
    'password.min' => 'Mínimo 8 caracteres.',
        'role.required' => 'Debes seleccionar un rol.',
        'foto.required' => 'La foto de perfil es obligatoria para el registro.' // Mensaje personalizado
        
    ]);

    // 📸 SUBIR FOTO A public/Imagenes
    $fotoNombre = null;

    if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
        $file = $request->file('foto');
        
        // Creamos un nombre único: ejemplo 1714285400_carlos.jpg
        $fotoNombre = time() . '_' . $file->getClientOriginalName();
        
        // Movemos el archivo directamente a public/Imagenes
        $file->move(public_path('Imagenes'), $fotoNombre);
    }

    // 🔐 CREAR USUARIO
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => $request->password, // El mutator en tu modelo User se encarga del Hash::make
        'role' => $request->role,
        'foto' => $fotoNombre // Guardamos solo el nombre del archivo
    ]);

    try {
        Mail::to($user->email)->send(
            new RegistroExitosoMail($user, $this->DatosGeneralesDeLaEmpresa())
        );
    } catch (\Exception $e) {
        Log::error("Error Mail: " . $e->getMessage());
    }

    return redirect('/login/admin')->with('success', 'Usuario registrado con éxito.');
}

    // 🟢 LOGIN
    public function loginPost(Request $request)
    {

  

$request->validate(['captcha' => 'required'], ['captcha.required' => 'Debes ingresar el captcha.']);

    $captchaUser = trim(strtoupper($request->captcha));
    $captchaSession = session('captcha_code'); // Ya está en mayúsculas desde el controlador

    // IMPORTANTE: Borrarlo apenas se lee para que no sea reutilizable
    session()->forget('captcha_code');

    if (!$captchaSession || $captchaUser !== $captchaSession) {
        return back()->with('error', 'Captcha incorrecto.')->withInput();
    }


        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'El correo no existe.');
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Contraseña incorrecta.');
        }

        session([
            'user' => $user,
            'last_activity' => time()
        ]);




        

        return redirect('/dashboard')
            ->with('success', 'Bienvenido ' . $user->name);



    }

    // 🟢 LOGOUT
    public function logout()
    {
        session()->forget(['user', 'last_activity']);
        session()->flush();
        return redirect('/login/admin');
    }

    
}