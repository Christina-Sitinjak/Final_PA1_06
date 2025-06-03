<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilAlumni extends Model
{
    use HasFactory;

    protected $table = 'profil_alumnis'; // Nama tabel
    protected $primaryKey = 'profil_alumni_id'; // Primary key
    protected $fillable = [ // Kolom yang boleh diisi (mass assignment)
        'user_id',
        'nama',
        'gambar',
        'tahun_lulus',
        'deskripsi',
    ];

    // Relasi ke tabel User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
