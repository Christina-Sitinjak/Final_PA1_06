<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveKategoriIdFromPesanKelasTable extends Migration
{
    public function up()
    {
        Schema::table('pesan_kelas', function (Blueprint $table) {
            // Hapus foreign key constraint terlebih dahulu
            $table->dropForeign(['kategori_id']);

            // Baru hapus kolomnya
            $table->dropColumn('kategori_id');
        });
    }

    public function down()
    {
        Schema::table('pesan_kelas', function (Blueprint $table) {
            $table->unsignedBigInteger('kategori_id')->nullable();

            // Tambahkan lagi foreign key kalau rollback
            $table->foreign('kategori_id')->references('kategori_id')->on('categories')->onDelete('cascade');
        });
    }
}

