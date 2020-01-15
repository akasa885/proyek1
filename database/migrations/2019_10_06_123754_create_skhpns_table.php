<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkhpnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skhpn', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_registrasi',10)->unique();
            $table->string('nama_lengkap');
            $table->string('tanggal_lahir');
            $table->text('gender');
            $table->string('alamat');
            $table->text('pekerjaan');
            $table->string('email_address');
            $table->text('keperluan');
            $table->string('status');
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
        Schema::dropIfExists('skhpn');
    }
}
