<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Menampilkan halaman form login.
     */
    public function showLoginForm()
    {
        return view('login'); // Pastikan file blade Anda ada di resources/views/auth/login.blade.php
    }


  public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials, $request->boolean('remember'))) {
        $request->session()->regenerate();

        // CEK ROLE DI SINI SETELAH LOGIN BERHASIL
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->intended('admin/dashboard');
        } 
        
        if ($user->role === 'user') {
            return redirect()->intended('user/user_dashboard');
        }

        // Default jika role tidak ditemukan
        return redirect('/');
    }

    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ])->onlyInput('email');
}

    /**
     * Menangani permintaan logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}