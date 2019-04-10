<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    //
	public $timestamps=false;

	protected $fillable = ['name'];

    
	public function proyeccions()
	{
		  return $this->hasMany('App\Proyeccion');
	}
}
