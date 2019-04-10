<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProyeccionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $salas = DB::table('salas')->get();
        foreach ($salas as $sala) {
        	 DB::table('proyeccions')->insert(['fecha' => '2019-04-09 20:00:00','sala_id'=>$sala->id,'pelicula_id'=>1]);
        }
    }
}
