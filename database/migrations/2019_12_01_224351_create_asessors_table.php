<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsessorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asessor', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_as',5);
            $table->string('nama');
            $table->string('birth_date',12);
            $table->string('birth_city',50);
            $table->string('distrik',20);
            $table->string('city',20);
            $table->string('photo_loc');
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
        Schema::dropIfExists('asessor');
    }
}
