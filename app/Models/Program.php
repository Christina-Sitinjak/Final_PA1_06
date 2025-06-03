<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $table = 'programs'; // Nama tabel
    protected $primaryKey = 'program_id'; // Primary key
    protected $fillable = [ // Kolom yang boleh diisi (mass assignment)
        'kategori_id',
        'user_id',
        'nama_program',
        'harga_pendaftaran',
        'harga_kursus',
        'masa_belajar',
        'stok',
    ];

    // Relasi ke tabel Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'kategori_id', 'kategori_id');
    }

    // Relasi ke tabel User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
