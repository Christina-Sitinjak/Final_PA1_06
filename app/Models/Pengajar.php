<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajar extends Model
{
    use HasFactory;

    protected $table = 'pengajars'; // Nama tabel
    protected $primaryKey = 'pengajar_id'; // Primary key
    protected $fillable = [ // Kolom yang boleh diisi (mass assignment)
        'user_id',
        'nama_pengajar',
        'gambar',
        'phone_number',
        'deskripsi',
    ];

    // Relasi ke tabel User (jika ada foreign key)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
