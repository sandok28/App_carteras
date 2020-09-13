<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cartera extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'estado',
        'usuario_id',
        'empresa_id'
];
}
