<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSosialisasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sosialisasi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_sos',10)->unique();
            $table->string('kode_pegawai')->nullable();
            $table->foreign('kode_pegawai')->references('kode_pegawai')->on('pegawai')->onDelete('cascade');
            $table->string('nama_pengada');
            $table->string('tgl_pengada');
            $table->string('sosialisasi_type');
            $table->string('waktu',7);
            $table->string('lokasi_tempat');
            $table->integer('jmlh_peserta');
            $table->string('nama_pj');
            $table->string('nomor_hp_pj');
            $table->string('keterangan');
            $table->string('lampiran_loc');
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
        Schema::dropIfExists('sosialisasi');
    }
}
