<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyeccion extends Model
{
    public $timestamps=false;

	protected $fillable = ['pelicula_id', 'sala_id'];

    public function fecha_horas()
    {
        return $this->hasMany('App\Fecha_hora');
    }

	public function pelicula()
    {
        return $this->belongsTo('App\Pelicula');
    }

	public function sala()
	{
		return $this->belongsTo('App\Sala');
	}


}
