<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $fillable = [
        'nombre',
        'cedula',
        'nit',
        'telefono',
        'direccion',
        'tipo',
        'estado',
        'usuario_id',
        'empresa_id'
    ];
}
    

