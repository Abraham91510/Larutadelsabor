<?php

namespace App\Http\Middleware\Usuario;

use Closure;

class SessionTimeout
{
    public function handle($request, Closure $next)
    {
        if (session()->has('last_activity_usuario')) {

            $inactive =
                time() - session('last_activity_usuario');

            if ($inactive > 600) {

                session()->forget('usuario');

                session()->forget('tipo_usuario');

                session()->forget('last_activity_usuario');

                return redirect('/login/usuario')
                    ->with(
                        'error',
                        'Sesión expirada'
                    );
            }
        }

        session([
            'last_activity_usuario' => time()
        ]);

        return $next($request);
    }
}