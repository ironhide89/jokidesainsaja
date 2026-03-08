<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
    'user_id', 'job_title', 'phone', 'about', 'skills', 'experience', 'photo', 'location', 'is_published'
];

protected $casts = [
    'skills' => 'array',
    'experience' => 'array',
    'is_published' => 'boolean',
];

public function user()
{
    return $this->belongsTo(User::class);
}
}
