<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pesan_kelas', function (Blueprint $table) {
            $table->id('pesan_kelas_id');
            $table->unsignedBigInteger('user_id'); // Foreign key ke tabel users
            $table->string('nama');
            $table->string('alamat');
            $table->string('asal_sekolah');
            $table->unsignedBigInteger('kategori_id'); // Foreign key ke tabel categories
            $table->string('tingkatan'); // 'sd', 'smp', 'sma'
            $table->integer('kelas'); // 1-6 (SD), 7-9 (SMP), 10-12 (SMA)
            $table->unsignedBigInteger('program_id'); // Foreign key ke tabel programs
            $table->string('jadwal'); // 'Senin-Rabu', 'Selasa-Kamis', 'Jumat-Sabtu'
            $table->enum('status', ['pending', 'approved', 'cancelled'])->default('pending'); // Status pemesanan
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('kategori_id')->references('kategori_id')->on('categories')->onDelete('restrict');
            $table->foreign('program_id')->references('program_id')->on('programs')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesan_kelas');
    }
};
