<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTatData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tat_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_registrasi')->unique();
            $table->string('instansi_pengaju');
            $table->string('nama_tersangka');
            $table->string('nik_ktp',16);
            $table->text('alamat');
            $table->string('tgl_penangkapan');
            $table->string('tgl_sprin_tangkap');
            $table->string('tgl_sprin_tahan');
            $table->string('barang_bukti');
            $table->string('berat');
            $table->string('nama_penyidik');
            $table->string('no_hp_penyidik',13);
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
        Schema::dropIfExists('tat_data');
    }
}
