<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
        $table->id();
        // Relasi ke tabel users
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        
        $table->string('job_title')->nullable(); // Contoh: Fullstack Developer...
        $table->string('phone')->nullable();     // Nomor HP
        $table->text('about')->nullable();        // Deskripsi "Tentang Saya"
        
        // Simpan Skill & Pengalaman dalam format JSON agar sesuai data dummy
        $table->json('skills')->nullable();      
        $table->json('experience')->nullable();  
        
        $table->string('photo')->nullable();     // Path foto profil
        $table->string('location')->nullable();  // Contoh: Bandar Lampung / Wamena
        
        $table->boolean('is_published')->default(true); 
        
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
