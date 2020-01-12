<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermintaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permintaan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_pegawai')->nullable();
            $table->foreign('kode_pegawai')->references('kode_pegawai')->on('pegawai')->onDelete('cascade');
            $table->string('kode_sosialisasi')->nullable();
            $table->foreign('kode_sosialisasi')->references('kode_sos')->on('sosialisasi')->onDelete('cascade');
            $table->string('kode_tat')->nullable();
            $table->foreign('kode_tat')->references('kode_registrasi')->on('tat_data')->onDelete('cascade');
            $table->string('kode_publik')->nullable();
            $table->foreign('kode_publik')->references('kode_registrasi')->on('publik_data')->onDelete('cascade');
            $table->string('kode_mandiri')->nullable();
            $table->foreign('kode_mandiri')->references('kode_registrasi')->on('mandiri')->onDelete('cascade');
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
        Schema::dropIfExists('permintaan');
    }
}
