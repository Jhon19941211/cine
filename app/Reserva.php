<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    public $timestamps=false;
    protected $fillable = ['estado','user_id','silla_id'];

    public function silla()
    {
    	return $this->belongsTo('App\Silla');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
