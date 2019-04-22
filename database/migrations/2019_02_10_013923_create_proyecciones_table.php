<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProyeccionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyeccions', function (Blueprint $table) {
            $table->increments('id');
            
            $table->unsignedInteger('fecha_hora_id');            
            $table->foreign('fecha_hora_id')->references('id')->on('fecha_horas');

            $table->unsignedInteger('pelicula_id');            
            $table->foreign('pelicula_id')->references('id')->on('peliculas');

            $table->unsignedInteger('sala_id');
            $table->foreign('sala_id')->references('id')->on('salas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proyeccions');
    }
}
