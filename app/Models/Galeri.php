<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    use HasFactory;

    protected $table = 'galeris'; // Nama tabel
    protected $primaryKey = 'galeri_id'; // Primary key
    protected $fillable = [ // Kolom yang boleh diisi (mass assignment)
        'user_id',
        'gambar',
        'deskripsi',
    ];

    // Relasi ke tabel User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
