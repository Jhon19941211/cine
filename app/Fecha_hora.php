<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fecha_hora extends Model
{
    public $timestamps=false;

	protected $fillable = ['hora', 'fecha'];

	public function proyeccions()
    {
        return $this->hasMany('App\Proyeccion');
    }
}
