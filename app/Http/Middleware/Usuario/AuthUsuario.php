<?php

namespace App\Http\Middleware\Usuario;

use Closure;

class AuthUsuario
{
    public function handle($request, Closure $next)
    {
        if (!session()->has('usuario')) {

            return redirect('/login/usuario')
                ->with(
                    'error',
                    'Debes iniciar sesión'
                );
        }

        return $next($request);
    }
}