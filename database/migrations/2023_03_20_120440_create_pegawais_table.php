<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();
            $table->string('nip', 40);
            $table->string('nama', 256);
            $table->string('golongan', 26);
            $table->date('tmt');
            $table->foreignId('jabatan_id');
            $table->date('masa_kerja');
            $table->string('nama_pelatihan', 128);
            $table->year('lulus_pelatihan');
            $table->integer('lama_kerja');
            $table->string('pendidikan', 50);
            $table->year('thn_lulus');
            $table->date('tgl_lahir');
            $table->string('gambar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pegawais');
    }
};
