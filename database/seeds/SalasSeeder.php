<?php

use Illuminate\Database\Seeder;

class SalasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('salas')->insert([
    		['genero' => 'Sala 1'],
    		['genero' => 'Sala 2'],
    		['genero' => 'Sala 3'],
    		['genero' => 'Sala 4'],
    		['genero' => 'Sala 5']
    	]);
    }
}
