<?php

namespace App\Http\Middleware\Administrador;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SessionTimeout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (session()->has('last_activity')) {

            $inactive = time() - session('last_activity');

            if ($inactive > 600) {
                session()->flush();
                return redirect('/login')->with('error', 'Sesión expirada');
            }
        }

        session(['last_activity' => time()]);

        return $next($request);
    }
}
