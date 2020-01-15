<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengaduanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengaduan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_registrasi',10)->unique();
            $table->string('fullName');
            $table->string('birth_date');
            $table->string('email');
            $table->string('no_hp');
            $table->string('alamat');
            $table->string('identitas_location');
            $table->string('pekerjaan');
            $table->string('nama_instansi');
            $table->string('instansi_location');
            $table->string('instansi_no');
            $table->string('kejadian_date');
            $table->string('kejadian_time');
            $table->string('pendukung_location')->nullable();
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
        Schema::dropIfExists('pengaduan');
    }
}
