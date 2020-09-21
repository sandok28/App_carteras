<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Novedad extends Model

    
{
    protected $table='novedades';
    protected $fillable = [
    
        'cartera_id',
        'novedad',
        'usuario_nombre',
        'fecha'
        
];
}

