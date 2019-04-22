<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Pelicula;

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
        $peliculas = Pelicula::all();

        foreach ($salas as $i => $sala) {            
        	DB::table('proyeccions')->insert(['fecha' => '2019-04-09 20:00:00','sala_id'=>$sala->id,'pelicula_id'=>$peliculas[$i]->id]);
        }
    }
}
