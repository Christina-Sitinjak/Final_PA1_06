<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesanKelas extends Model
{
    use HasFactory;

    protected $table = 'pesan_kelas';
    protected $primaryKey = 'pesan_kelas_id';
    protected $fillable = [
        'user_id',
        'nama',
        'alamat',
        'asal_sekolah',
        'tingkatan',
        'kelas',
        'program_id',
        'jadwal',
        'status',
    ];

    // Relasi ke tabel User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke tabel Program
    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id', 'program_id');
    }
}
