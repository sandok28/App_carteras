<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';
    //

    protected $fillable = [
            'cliente_id',
            'nombre',
            'direccion',
            'telefono',
            'cedula',
            'cartera_id',
            'fecha_ultima_visita',
            'posicion',
            'deuda'
        ];
}
