<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SalasSeeder::class);     
        //$this->call(Fecha_Hora_Seeder::class);        
        //$this->call(ProyeccionesSeeder::class);
    }
}
