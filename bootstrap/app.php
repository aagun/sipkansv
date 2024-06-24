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
    ->withMiddleware(function (Middleware $middleware) {
        if (in_array(env('APP_ENV'), ['testing', 'local'])) {
            $middleware->validateCsrfTokens(except: [
                '*'
            ]);
        }
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (Throwable $t, $request) {
        });
    })->create();
