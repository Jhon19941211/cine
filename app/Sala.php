<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
	public $timestamps=false;

	protected $fillable = ['cant_filas', 'cant_columnas'];

	public function proyeccions()
	{
		  return $this->hasMany('App\Proyeccion');
	}

	public function sillas()
	{
		  return $this->hasMany('App\Silla');
	}
}
