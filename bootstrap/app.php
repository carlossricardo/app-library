<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\JwtMiddleware;
use App\Http\Middleware\ProfileMiddleware;
use App\Http\Middleware\PrivilegeMiddleware;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // $middleware->append(JwtMiddleware::class);
        // $middleware->alias([
        //     'jwt-middleware' => JwtMiddleware::class
        // ]);
        // $middleware->alias([
        //     'profile-middleware' => ProfileMiddleware::class
        // ]);
        $middleware->alias([
            'jwt-middleware' => JwtMiddleware::class,
            'profile-middleware' => ProfileMiddleware::class,
            'privilege-middleware' => PrivilegeMiddleware::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
