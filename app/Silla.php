<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Silla extends Model
{
	public $timestamps=false;
	protected $fillable = ['fila','columna','sala_id'];

	public function sala()
	{
		return $this->belongsTo('App\Sala');
	}

	public function reservas()
	{
		return $this->hasMany('App\Reserva');
	}
}
