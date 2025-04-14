<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    use HasFactory;

    protected $table = 'galeri'; // Nama tabel di database
    protected $primaryKey = 'galeri_id'; // Primary key tabel
    public $timestamps = true; // Menggunakan timestamps (created_at, updated_at)
    protected $fillable = [
        'gambar',
        'deskripsi',
    ];
}
