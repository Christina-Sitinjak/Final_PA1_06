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
        Schema::create('jadwal_belajars', function (Blueprint $table) {
            $table->id('jadwal_belajar_id'); // Primary key

            $table->unsignedBigInteger('program_id'); // Foreign key ke tabel programs
            $table->unsignedBigInteger('user_id'); // Foreign key ke tabel users (admin)

            $table->string('hari'); // "Senin-Rabu", "Selasa-Kamis", "Jumat-Sabtu"
            $table->time('jam_mulai');
            $table->time('jam_berakhir');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('program_id')->references('program_id')->on('programs')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_belajars');
    }
};
