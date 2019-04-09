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
            $table->boolean('silla1');
            $table->boolean('silla2');
            $table->boolean('silla3');
            $table->boolean('silla4');
            $table->boolean('silla5');
            $table->boolean('silla6');
            $table->boolean('silla7');
            $table->boolean('silla8');
            $table->boolean('silla9');
            $table->boolean('silla10');

            $table->unsignedInteger('horario_id');
            $table->foreign('horario_id')->references('id')->on('horarios');

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
        Schema::dropIfExists('sillas');
    }
}
