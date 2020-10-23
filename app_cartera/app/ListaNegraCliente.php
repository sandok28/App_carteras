<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListaNegraCliente extends Model
{
    protected $table='listanegraclientes';
     protected $fillable = [
                'cliente_id',
                'monto_ingreso',
                'estado'
];

}
