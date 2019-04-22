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
        DB::table('fecha_horas')->insert(['hora' => '18:00:00', 'fecha_inicio' => '2019-04-22', 'fecha_fin' => '2019-04-28']);
        DB::table('fecha_horas')->insert(['hora' => '20:00:00', 'fecha_inicio' => '2019-04-22', 'fecha_fin' => '2019-04-28']);
        DB::table('fecha_horas')->insert(['hora' => '22:00:00', 'fecha_inicio' => '2019-04-22', 'fecha_fin' => '2019-04-28']);
    }
}
