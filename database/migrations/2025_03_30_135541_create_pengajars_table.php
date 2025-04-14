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
        Schema::create('pengajar', function (Blueprint $table) {
            $table->id('pengajar_id'); // Auto-incrementing primary key
            $table->string('nama_pengajar');
            $table->string('gambar')->nullable(); //nullable agar boleh kosong
            $table->string('phone_number');
            $table->text('deskripsi')->nullable(); //nullable agar boleh kosong
            $table->timestamps(); // created_at dan updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajar');
    }
};
