<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories'; // Nama tabel
    protected $primaryKey = 'kategori_id'; // Primary key
    protected $fillable = [ // Kolom yang boleh diisi (mass assignment)
        'user_id',
        'nama_kategori',
    ];

    // Relasi ke tabel User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
