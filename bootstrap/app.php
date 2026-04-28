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
    'session.timeout' => \App\Http\Middleware\Administrador\SessionTimeout::class,
    'role' => \App\Http\Middleware\Administrador\RoleMiddleware::class,
]);


    
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
