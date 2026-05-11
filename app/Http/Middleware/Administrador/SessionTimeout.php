<?php

namespace App\Http\Middleware\Administrador;

use Closure;

class SessionTimeout
{
    public function handle($request, Closure $next)
    {
        if (session()->has('last_activity_admin')) {

            $inactive =
                time() - session('last_activity_admin');

            if ($inactive > 600) {

                session()->forget('admin');

                session()->forget('last_activity_admin');

                return redirect('/login/admin')
                    ->with(
                        'error',
                        'Sesión expirada'
                    );
            }
        }

        session([
            'last_activity_admin' => time()
        ]);

        return $next($request);
    }
}