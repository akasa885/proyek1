<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublikData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publik_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_registrasi')->unique();
            $table->string('tgl_kedatangan');
            $table->string('birth_date');
            $table->string('nama_lengkap');
            $table->text('gender');
            $table->string('umur',3);
            $table->string('nik_ktp',16);
            $table->text('agama');
            $table->text('suku');
            $table->string('narkoba');
            $table->text('status');
            $table->string('nama_ibu');
            $table->string('nama_ayah');
            $table->text('alamat');
            $table->string('no_hp',13);
            $table->string('no_hp_keluarga',13);
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
        Schema::dropIfExists('publik_data');
    }
}
