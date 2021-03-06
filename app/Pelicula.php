<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelicula extends Model
{
    public $timestamps=false;

	protected $fillable = ['id', 'nombre','genero','sinopsis'];

	public function proyeccions()
    {
        return $this->hasMany('App\Proyeccion');
    }
}
