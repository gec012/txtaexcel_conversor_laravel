<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePadronSagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('padron_sag', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('cod_tip_documento');
            $table->string('nro_documento');
            $table->integer('archivo_id')->unsigned()->nullable();
            $table->foreign('archivo_id')->references('id')->on('archivos')->onDelete('cascade');
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
        Schema::dropIfExists('padron_sag');
    }
}
