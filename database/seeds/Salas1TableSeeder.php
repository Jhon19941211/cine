<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class Salas1TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <= 5; $i++) { 
            DB::table('salas')->insert([['cant_columnas' => 5, 'cant_filas' => 2]]);
        } 	
    }
}
