<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelas', function (Blueprint $table) {
            $table->id('kelas_id'); // Otomatis menjadi primary key dan auto-increment
            $table->string('nama_kelas');
            $table->integer('masa_belajar'); //misalnya dalam satuan bulan
            $table->decimal('harga_pendaftaran', 10, 2); //Decimal(total digit, angka desimal)
            $table->decimal('harga_kursus', 10, 2);
            $table->timestamps(); //created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kelas');
    }
}
