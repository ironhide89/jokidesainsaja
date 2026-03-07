<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('index');
});

Route::get('/portofolio', function () {
    return view('portofolio');
})->name('portofolio');


Route::middleware(['guest'])->group(function () {
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
});

Route::post('logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('user_admin', [AdminController::class, 'user_admin'])->name('admin.user_admin');
    Route::post('users', [AdminController::class, 'store'])->name('admin.users.store');
    Route::put('users/{user}', [AdminController::class, 'update'])->name('admin.users.update');
    Route::delete('users/{user}', [AdminController::class, 'destroy'])->name('admin.users.destroy'); 
});


Route::middleware(['auth', 'role:user'])->prefix('user')->group(function () {
    Route::get('user_dashboard', function () {
        return view('user.dashboard'); 
    })->name('user.dashboard');
    
    Route::get('portofolios_user', [UserController::class, 'portofolios_user'])->name('user.portofolios_user');

});