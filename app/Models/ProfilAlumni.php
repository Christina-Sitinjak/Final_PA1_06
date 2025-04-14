<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilAlumni extends Model
{
    use HasFactory;
    protected $table = 'profil_alumni'; // Nama tabel
    protected $primaryKey = 'profil_alumni_id'; // Primary key
    public $timestamps = true; // Aktifkan timestamps
    protected $fillable = [
        'nama',
        'gambar',
        'tahun_lulus',
        'deskripsi',
    ];
}
