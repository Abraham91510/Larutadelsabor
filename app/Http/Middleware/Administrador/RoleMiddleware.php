<?php

namespace App\Http\Middleware\Administrador;

use Closure;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (!session()->has('user')) {
            return redirect('/login/admin');
        }

        $user = session('user');

        if ($user->role !== $role) {
            return redirect('/dashboard');
        }

        return $next($request);
    }
}