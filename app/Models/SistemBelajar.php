<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SistemBelajar extends Model
{
    use HasFactory;

    protected $table = 'sistem_belajars'; // Nama tabel
    protected $primaryKey = 'sistem_belajar_id'; // Primary key
    protected $fillable = [ // Kolom yang boleh diisi (mass assignment)
        'user_id',
        'judul',
        'deskripsi',
        'ikon',
    ];

    // Relasi ke tabel User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
