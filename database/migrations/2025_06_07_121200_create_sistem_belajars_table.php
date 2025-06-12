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
        Schema::create('sistem_belajars', function (Blueprint $table) {
            $table->id('sistem_belajar_id'); // Auto-incrementing primary key
            $table->unsignedBigInteger('user_id'); // Foreign key ke tabel users
            $table->string('judul');
            $table->text('deskripsi');
            $table->string('ikon')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sistem_belajars');
    }
};
