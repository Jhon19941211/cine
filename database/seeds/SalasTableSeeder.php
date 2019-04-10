<?php

use Illuminate\Database\Seeder;

class SalasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('salas')->insert([
    		['name' => 'Sala 1'],
    		['name' => 'Sala 2'],
    		['name' => 'Sala 3'],
    		['name' => 'Sala 4'],
    		['name' => 'Sala 5']
    	]);
    }
}
