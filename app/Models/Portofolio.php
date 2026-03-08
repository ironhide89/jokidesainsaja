<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\PortofolioImage;

class Portofolio extends Model
{
    // Sesuaikan nama tabel jika Laravel otomatis mencari 'portofolios'
    protected $table = 'portfolios'; 

    protected $fillable = [
    'user_id', 'title', 'slug', 'category', 'subcategory', 'description', 'project_url'
];

    // Relasi balik ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        // 'portofolio_id' adalah nama kolom foreign key di tabel portfolio_images
        return $this->hasMany(PortofolioImage::class, 'portofolio_id');
    }
}