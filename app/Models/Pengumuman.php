<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory;

    protected $table = 'pengumuman';
    protected $primaryKey = 'pengumuman_id';
    public $timestamps = true;
    protected $fillable = [
        'judul_pengumuman',
        'tanggal',
        'deskripsi',
    ];
    protected $casts = [
        'tanggal' => 'date',
    ];
}
