<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonasUnsaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persona_unsa', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipo_documento');
            $table->string('numero_documento');
            $table->string('nombre_apellido');
            $table->string('codigo');
            $table->float('monto');
            $table->timestamp('año_mes');
            $table->integer('archivo_id')->unsigned();
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
        Schema::dropIfExists('persona_unsa');
    }
}
