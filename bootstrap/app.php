<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request; // Tambahkan baris ini untuk mendapatkan class Request

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // 1. Mendaftarkan alias middleware role kamu
        $middleware->alias([
            'role' => \App\Http\Middleware\CheckRole::class,
        ]);

        // 2. Menentukan tujuan redirect bagi user yang sudah login (guest redirection)
        $middleware->redirectUsersTo(function (Request $request) {
            $user = $request->user();

            // Jika role adalah admin, lempar ke dashboard admin
            if ($user && $user->role === 'admin') {
                return route('admin.dashboard');
            }

            // Jika selain admin (user biasa), lempar ke dashboard user
            return route('user.dashboard');
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();