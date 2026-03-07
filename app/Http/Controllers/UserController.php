<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
     public function portofolios_user()
    {
    
        return view('user.portofolios'); 
    }
}
