<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListaNegra extends Model
{
    protected $table='listanegras';
     protected $fillable = [
                'cliente_id',
                'monto_ingreso',
                'estado'
];

}
