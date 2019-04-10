<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSillasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sillas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fila');
            $table->integer('columna');
            $table->unsignedInteger('proyeccion_id');

            $table->foreign('proyeccion_id')->references('id')->on('proyecciones');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sillas');
    }
}
