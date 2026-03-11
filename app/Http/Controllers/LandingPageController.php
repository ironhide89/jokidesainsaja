<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portofolio;
use App\Models\User;

class LandingPageController extends Controller
{
   public function index()
{
    // Ambil 3 portofolio secara acak
    $portfolios = \App\Models\Portofolio::with('images')->inRandomOrder()->limit(3)->get();
    
    // Ambil User yang rolenya 'user', bukan 'admin'
    $users = \App\Models\User::with('profile')
                ->where('role', 'user') // Filter berdasarkan kolom role
                ->get(); 
    
    return view('index', compact('portfolios', 'users'));
}
}