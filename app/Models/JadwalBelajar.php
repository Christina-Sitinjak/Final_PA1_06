<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalBelajar extends Model
{
    use HasFactory;

    protected $table = 'jadwal_belajars'; // Nama tabel
    protected $primaryKey = 'jadwal_belajar_id'; // Primary key
    protected $fillable = [ // Kolom yang boleh diisi (mass assignment)
        'program_id',
        'user_id',
        'hari',
        'jam_mulai',
        'jam_berakhir',
    ];

    // Relasi ke tabel Program
    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id', 'program_id');
    }

    // Relasi ke tabel User (Admin yang membuat jadwal)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
