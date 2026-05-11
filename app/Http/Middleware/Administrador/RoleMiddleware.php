<?php

namespace App\Http\Middleware\Administrador;

use Closure;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (!session()->has('admin')) {

            return redirect('/login/admin');
        }

        $admin = session('admin');

        if ($admin->role !== $role) {

            return redirect('/dashboard');
        }

        return $next($request);
    }
}