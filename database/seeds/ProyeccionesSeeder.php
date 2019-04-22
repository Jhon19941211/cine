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
        DB::table('proyeccions')->insert(['pelicula_id' => 299537, 'sala_id' => 1]);
    }
}
