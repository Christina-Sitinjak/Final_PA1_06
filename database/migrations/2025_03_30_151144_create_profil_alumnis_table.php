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
        Schema::create('profil_alumni', function (Blueprint $table) {  // Nama tabel: profil_alumni
            $table->id('profil_alumni_id'); // Auto-incrementing primary key
            $table->string('nama');
            $table->string('gambar')->nullable(); //nullable agar boleh kosong
            $table->integer('tahun_lulus');
            $table->text('deskripsi')->nullable(); //nullable agar boleh kosong
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_alumni');  // Nama tabel: profil_alumni
    }
};
