<?php

namespace App\Http\Middleware\Usuario;

use Closure;

class RoleMiddleware
{
   public function handle($request, Closure $next, $role)
    {
        if (!session()->has('user')) {

            return redirect('/login/usuario');
        }

        $tipo = session('tipo_usuario');

        if ($tipo !== $role) {

            return redirect('/inicio/usuario');
        }

        return $next($request);
    }
}