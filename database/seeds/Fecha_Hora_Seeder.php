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
        DB::table('fecha_horas')->insert(['hora1' => '18:00:00', 'fecha' => '2019-04-10', 'proyeccion_id' => 1]);
        DB::table('fecha_horas')->insert(['hora1' => '20:00:00', 'fecha' => '2019-04-10', 'proyeccion_id' => 1]);
        DB::table('fecha_horas')->insert(['hora1' => '22:00:00', 'fecha' => '2019-04-10', 'proyeccion_id' => 1]);
    }
}
