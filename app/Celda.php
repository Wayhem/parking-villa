<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Celda extends Model
{
    protected $fillable=[
        'idingreso', 'a_time', 'libre', 'posicion','codename'
    ];
    public function ingreso(){
        return $this->belongsTo('App\Ingreso');
    }
}
