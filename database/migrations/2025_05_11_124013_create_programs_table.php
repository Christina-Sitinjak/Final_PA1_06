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
        Schema::create('programs', function (Blueprint $table) {
            $table->id('program_id'); // Auto-incrementing primary key
            $table->unsignedBigInteger('kategori_id'); // Foreign key ke tabel categories
            $table->unsignedBigInteger('user_id'); // Foreign key ke tabel users (admin)
            $table->string('nama_program');
            $table->decimal('harga_pendaftaran', 10, 2); // Harga pendaftaran dengan 2 desimal
            $table->decimal('harga_kursus', 10, 2); // Harga kursus dengan 2 desimal
            $table->integer('masa_belajar'); // Masa belajar (misalnya, dalam bulan)
            $table->integer('stok'); // Stok program
            $table->timestamps();

            // Definisikan foreign keys
            $table->foreign('kategori_id')->references('kategori_id')->on('categories')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
