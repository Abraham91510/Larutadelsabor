<?php

namespace App\Http\Middleware\Usuario;

use Closure;

class AuthUsuario
{
    public function handle($request, Closure $next)
    {
        if (!session()->has('user')) {
            return redirect('/login/usuario');
        }

        return $next($request);
    }
}