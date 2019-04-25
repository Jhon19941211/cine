<?php

use Illuminate\Database\Seeder;

class Fecha_Hora_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fecha_horas')->insert(['hora' => '18:00:00', 'fecha' => '2019-04-24']);
        DB::table('fecha_horas')->insert(['hora' => '20:00:00', 'fecha' => '2019-04-24']);
        DB::table('fecha_horas')->insert(['hora' => '22:00:00', 'fecha' => '2019-04-24']);    
    }
}
