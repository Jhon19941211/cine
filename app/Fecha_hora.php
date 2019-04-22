<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fecha_hora extends Model
{
    public $timestamps=false;

	protected $fillable = ['hora1','fecha', 'proyeccion_id'];

	public function proyeccions()
    {
        return $this->belongsTo('App\Proyeccion');
    }
}
