<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Creador extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function juegos(){
        return $this->hasMany('App\Juego');
    }


}
