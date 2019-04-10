<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyeccion extends Model
{
    //

    public $timestamps=false;

	protected $fillable = ['fecha','sla_id','pelicula_id'];


	public function pelicula()
    {
        return $this->belongsTo('App\Pelicula');
    }

	public function sala()
	{
		return $this->belongsTo('App\Sala');
	}


	public function sillas()
    {
        return $this->hasMany('App\Silla');
    }
}
