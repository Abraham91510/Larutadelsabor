<?php

namespace App\Http\Middleware\Administrador;

use Closure;

class AuthAdmin
{
    public function handle($request, Closure $next)
    {
        if (!session()->has('admin')) {

            return redirect('/login/admin')
                ->with(
                    'error',
                    'Debes iniciar sesión'
                );
        }

        return $next($request);
    }
}