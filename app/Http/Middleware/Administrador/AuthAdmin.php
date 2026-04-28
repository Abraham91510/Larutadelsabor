<?php

namespace App\Http\Middleware\Administrador;

use Closure;

class AuthAdmin
{
    public function handle($request, Closure $next)
    {
        if (!session()->has('user')) {
            return redirect('/login/admin');
        }

        return $next($request);
    }
}