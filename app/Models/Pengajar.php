<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajar extends Model
{
    use HasFactory;

    protected $table = 'pengajar'; // Nama tabel di database
    protected $primaryKey = 'pengajar_id'; // Nama kolom primary key
    public $timestamps = true; // Aktifkan timestamps (created_at, updated_at)
    protected $fillable = [
        'nama_pengajar',
        'gambar',
        'phone_number',
        'deskripsi',
    ];
}
