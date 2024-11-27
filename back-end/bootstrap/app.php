<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\JwtMiddleware;

return Application::configure(basePath: dirname(__DIR__))
->withRouting(
    web: __DIR__.'/../routes/web.php',
    api: __DIR__.'/../routes/api.php',
    commands: __DIR__.'/../routes/console.php',
    health: '/up',
)
    ->withMiddleware(function (Middleware $middleware) {
        //$middleware->append(JwtMiddleware::class);
        // $middleware->aliases([
        //     'workspace.owner' => \App\Http\Middleware\WorkspaceOwnerMiddleware::class,
        // ]);
        
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();