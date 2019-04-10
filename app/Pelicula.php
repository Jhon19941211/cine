<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelicula extends Model
{
    //
    public $timestamps=false;

	protected $fillable = ['name','genero','sinopsis'];

	public function proyeccions()
    {
        return $this->hasMany('App\Proyeccion');
    }

}
