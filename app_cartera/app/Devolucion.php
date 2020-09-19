<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Devolucion extends Model
{
    //
    protected $table = 'devoluciones';
    
    protected $fillable = [
        'devolucion_id',
        'fecha',
        'producto_id',
        'producto_cantidad'
        
];
}
