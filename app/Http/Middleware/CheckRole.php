<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
   public function handle(Request $request, Closure $next, string $role)
{
    // 1. Jika belum login, lempar ke halaman login
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    // 2. Jika role tidak sesuai dengan yang diminta Route
    if (Auth::user()->role !== $role) {
        
        // Jika dia Admin tapi mencoba akses area User, balikkan ke Dashboard Admin
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard')->with('error', 'Anda tidak diizinkan mengakses area User.');
        }

        // Jika dia User tapi mencoba akses area Admin, balikkan ke Dashboard User
        if (Auth::user()->role === 'user') {
            return redirect()->route('user.dashboard')->with('error', 'Anda tidak memiliki akses Admin.');
        }

        // Jika role tidak dikenal, paksa logout atau abort
        Auth::logout();
        return redirect()->route('login');
    }

    return $next($request);
}
}
