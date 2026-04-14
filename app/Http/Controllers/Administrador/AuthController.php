<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Administrador\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login()
    {
        return view('administrador.pages.login');
    }

    public function register()
    {
        return view('administrador.pages.register');
    }

    public function saveRegister(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required',
        'role' => 'required'
    ]);

    $user = User::create($request->all());

    // 🔥 CONTROL DE ERROR EN CORREO
    try {
        Mail::raw('Registro exitoso. Ir al login: http://localhost:8000/login', function ($msg) use ($user) {
            $msg->to($user->email)
                ->subject('Registro exitoso');
        });
    } catch (\Exception $e) {
        // Opcional: guardar error en log
        Log::error('Error al enviar correo: ' . $e->getMessage());
    }

    return redirect('/login')->with('success', 'Registrado correctamente');
}

    public function loginPost(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Credenciales incorrectas');
        }

        session([
            'user' => $user,
            'last_activity' => time()
        ]);

        return redirect('/dashboard');
    }

    public function logout()
    {
        session()->flush();
        return redirect('/login');
    }
}