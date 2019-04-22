<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFechaHorasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fecha_horas', function (Blueprint $table) {
            $table->increments('id');
            $table->time('hora1');
            $table->date('fecha');

            $table->unsignedInteger('proyeccion_id');
            $table->foreign('proyeccion_id')->references('id')->on('proyeccions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fecha_horas');
    }
}
