<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Hash;

class ProfileSeeder extends Seeder
{
    public function run(): void
    {
        // Buat User
        $user = User::create([
            'name'     => 'Rakha Racahyo',
            'email'    => 'rakharacahyo@example.com',
            'password' => Hash::make('password'),
            'role'     => 'user',
        ]);

        // Buat Profil
        Profile::create([
            'user_id'   => $user->id,
            'job_title' => 'Fullstack Developer & Airport Technical Specialist',
            'phone'     => '081234567890',
            'location'  => 'Bandar Lampung / Wamena',
            'about'     => 'Lulusan D4 Teknologi Rekayasa Bandar Udara yang memiliki minat tinggi di bidang coding dan manajemen infrastruktur.',
            'skills'    => ['Laravel', 'Tailwind CSS', 'AutoCAD', 'Electrical Engineering'],
            'experience' => [
                [
                    'year'  => '2025 - Sekarang', 
                    'pos'   => 'CPNS Pengevaluasi Penerbangan', 
                    'place' => 'UPBU Wamena'
                ],
                [
                    'year'  => '2021 - 2025', 
                    'pos'   => 'Mahasiswa Teknologi Rekayasa', 
                    'place' => 'Poltekbang Palembang'
                ]
            ],
            'is_published' => true,
        ]);
    }
}