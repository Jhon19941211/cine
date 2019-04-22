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
        DB::table('proyeccions')->insert(['fecha_hora_id' => 1, 'pelicula_id' => 299537, 'sala_id' => 1]);
        DB::table('proyeccions')->insert(['fecha_hora_id' => 2, 'pelicula_id' => 299537, 'sala_id' => 1]);
        DB::table('proyeccions')->insert(['fecha_hora_id' => 3, 'pelicula_id' => 299537, 'sala_id' => 1]);
    }
}
