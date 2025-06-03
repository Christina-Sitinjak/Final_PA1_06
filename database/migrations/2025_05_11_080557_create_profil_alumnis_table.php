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
        Schema::create('profil_alumnis', function (Blueprint $table) {
            $table->id('profil_alumni_id'); // Auto-incrementing primary key
            $table->unsignedBigInteger('user_id'); // Foreign key ke tabel users
            $table->string('nama');
            $table->string('gambar');
            $table->year('tahun_lulus');
            $table->text('deskripsi')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_alumnis');
    }
};
