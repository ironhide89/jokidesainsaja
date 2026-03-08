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
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke User (Siapa yang membuat portofolio ini)
            // onDelete('cascade') artinya jika user dihapus, portofolionya ikut terhapus
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Data Portofolio
            $table->string('title'); // Judul Proyek (Sistem Informasi, dll)
            $table->string('slug')->unique(); // Untuk URL SEO friendly (misal: sistem-informasi-akademik)
            
            // Kategori (disesuaikan dengan filter di view: programming, penulisan, desain)
            $table->string('category'); 
            
            // Deskripsi singkat (di view dummy kamu ada teks keterangan di bawah judul)
            $table->text('description')->nullable(); 
            
            
            // Link tambahan (Opsional, misal link GitHub atau Behance)
            $table->string('project_url')->nullable(); 

            $table->string('subcategory')->nullable(); // Tambahkan baris ini

            $table->timestamps();

            

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};