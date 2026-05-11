<?php

namespace App\Http\Middleware\Usuario;

use Closure;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (!session()->has('usuario')) {

            return redirect('/login/usuario');
        }

        $tipo = session('tipo_usuario');

        if ($tipo !== $role) {

            return redirect('/plataforma/inicio');
        }

        return $next($request);
    }
}