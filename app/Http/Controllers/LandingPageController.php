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

    public function portofolio_all()
{
    // Mengambil semua portofolio beserta gambarnya, diurutkan dari yang terbaru
    $portfolios = \App\Models\Portofolio::with('images')->latest()->get();
    
    return view('portofolio', compact('portfolios'));
}

public function portofolio_detail($slug)
{
    // Cari portofolio berdasarkan slug, jika tidak ada munculkan 404
    $portfolio = \App\Models\Portofolio::with(['images', 'user.profile'])
        ->where('slug', $slug)
        ->firstOrFail();

    return view('portofolio_detail', compact('portfolio'));
}

public function profile_detail($id)
{
    // Pastikan tulisannya 'portfolios' (pakai 'f')
    $user = \App\Models\User::with(['profile', 'portfolios.images'])->findOrFail($id);

    return view('profile_detail', compact('user'));
}

}