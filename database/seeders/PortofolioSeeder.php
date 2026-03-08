<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Portofolio;
use App\Models\User;
use Illuminate\Support\Str;

class PortofolioSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil user pertama yang ada di database
        $user = User::first();

        if (!$user) {
            $this->command->info('User tidak ditemukan, silakan jalankan UserProfileSeeder dulu!');
            return;
        }

        $projects = [
            [
                'title' => 'Sistem Informasi Akademik',
                'category' => 'programming',
                'description' => 'Sistem manajemen data mahasiswa dan nilai berbasis web menggunakan Laravel.',
            ],
            [
                'title' => 'Desain Branding Startup',
                'category' => 'desain',
                'description' => 'Pembuatan logo, kartu nama, dan identitas visual untuk perusahaan rintisan.',
            ],
            [
                'title' => 'Penulisan Artikel SEO',
                'category' => 'penulisan',
                'description' => 'Optimasi konten blog dengan teknik keyword research untuk meningkatkan traffic.',
            ],
            [
                'title' => 'Landing Page Properti',
                'category' => 'programming',
                'description' => 'Pembuatan halaman penjualan properti yang responsif dan konversinya tinggi.',
            ],
            [
                'title' => 'Parafrase Jurnal Ilmiah',
                'category' => 'penulisan',
                'description' => 'Jasa perbaikan struktur kalimat jurnal agar lolos pengecekan Turnitin.',
            ],
            [
                'title' => 'Model 3D Arsitektur Rumah',
                'category' => 'desain',
                'description' => 'Visualisasi rumah tinggal menggunakan AutoCAD dan SketchUp.',
            ],
        ];

        foreach ($projects as $project) {
            Portofolio::create([
                'user_id'     => $user->id,
                'title'       => $project['title'],
                'slug'        => Str::slug($project['title']),
                'category'    => $project['category'],
                'description' => $project['description'],
                'project_url' => 'https://jokidesainsaja.com',
            ]);
        }
    }
}