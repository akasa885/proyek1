<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawai', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('kode_pegawai',5)->unique();
          $table->string('nama');
          $table->string('birth_date',15);
          // $table->string('birth_city',50);
          $table->string('distrik',20);
          $table->string('city',20);
          $table->string('departemen');
          $table->string('bagian');
          $table->string('photo_loc');
          $table->string('add_by');
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
        Schema::dropIfExists('pegawai');
    }
}
