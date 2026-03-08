<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PortofolioImage extends Model
{
    // Nama tabel di database
    protected $table = 'portfolio_images';

    // Kolom yang boleh diisi massal
    protected $fillable = ['portofolio_id', 'image_path'];

    /**
     * Relasi balik ke Portofolio
     */
    public function portofolio()
    {
        return $this->belongsTo(Portofolio::class, 'portofolio_id');
    }
}