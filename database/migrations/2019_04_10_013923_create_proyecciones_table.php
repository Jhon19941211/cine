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
            $table->dateTime('fecha');

            $table->unsignedInteger('sala_id');
            $table->foreign('sala_id')->references('id')->on('salas');
            
            $table->unsignedInteger('pelicula_id');            
            $table->foreign('pelicula_id')->references('id')->on('peliculas');

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
