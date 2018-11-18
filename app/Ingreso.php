<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    //protected $table = 'ingresos'; tomado por defecto
    //protected $primaryKey = 'id'; tomado por defecto
    protected $fillable = ['plate', 'brand', 'preciofinal', 'initc'];

    public function celda()
    {
        return $this->hasOne('App\Ingreso');
    }
}
