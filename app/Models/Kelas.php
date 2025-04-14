<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas'; // Optional, jika nama tabel berbeda dengan konvensi (lowercase, plural dari nama model)
    protected $primaryKey = 'kelas_id'; // Jika nama primary key bukan 'id' 
    public $timestamps = true; // Secara default true. Jika tidak ingin menggunakan timestamps, set ke false
    protected $fillable = [
        'nama_kelas',
        'masa_belajar',
        'harga_pendaftaran',
        'harga_kursus',
    ];
}
