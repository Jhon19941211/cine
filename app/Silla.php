<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Silla extends Model
{
    //
     public $timestamps=false;
     protected $fillable = ['fila','columna','proyeccion_id'];


     public function proyeccion()
	{
		return $this->belongsTo('App\Proyeccion');
	}


	public function reservas()
	{
		  return $this->hasMany('App\Reserva');
	}

}
