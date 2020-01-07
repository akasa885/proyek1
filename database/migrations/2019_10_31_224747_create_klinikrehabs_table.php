<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKlinikrehabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('klinikrehab', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_id');
            $table->string('kode_registrasi');
            $table->foreign('kode_registrasi')->references('kode_registrasi')->on('skhpn')->onDelete('cascade');
            $table->string('medicalDate',10);
            $table->string('medicalTime',5);
            $table->string('medicalLocation');
            $table->string('kesadaran');
            $table->string('keadaan_umum');
            $table->string('tekananDarah',7);
            $table->string('nadi',3);
            $table->string('breath',3);
            $table->string('medicineUse',1);
            $table->string('medicineType')->nullable();
            $table->string('medicineFrom')->nullable();
            $table->string('lastDrink')->default('0');
            $table->string('rAmphetamine',1);
            $table->string('rMethaphetamine',1);
            $table->string('rTHC',1);
            $table->string('rMorphin',1);
            $table->string('rBenzodiazepine',1);
            $table->string('rCocaine',1);
            $table->string('add_by');
            $table->string('update_by')->nullable();
            $table->string('medicalResult',1);
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
        Schema::dropIfExists('klinikrehab');
    }
}
