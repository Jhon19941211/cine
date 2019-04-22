<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyeccion extends Model
{
    public $timestamps=false;

	protected $fillable = ['fecha_hora_id', 'pelicula_id', 'sala_id'];

    public function fecha_hora()
    {
        return $this->belongsTo('App\Fecha_hora');
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
