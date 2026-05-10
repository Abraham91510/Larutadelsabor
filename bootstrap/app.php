<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //

        $middleware->alias([
    'auth.admin' => \App\Http\Middleware\Administrador\AuthAdmin::class,
    'session.timeout.admin' => \App\Http\Middleware\Administrador\SessionTimeout::class,
    'role.admin' => \App\Http\Middleware\Administrador\RoleMiddleware::class,


        'auth.usuario' =>
            \App\Http\Middleware\Usuario\AuthUsuario::class,

        'session.timeout.usuario' =>
            \App\Http\Middleware\Usuario\SessionTimeout::class,

        'role.usuario' =>
            \App\Http\Middleware\Usuario\RoleMiddleware::class,

    ]);

    
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
