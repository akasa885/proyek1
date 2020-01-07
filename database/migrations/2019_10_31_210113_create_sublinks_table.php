<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSublinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sublinks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('instagram')->default('#');
            $table->string('facebook')->default('#');
            $table->string('youtube')->default('#');
            $table->string('linked_link')->default('#');
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
        Schema::dropIfExists('sublinks');
    }
}
