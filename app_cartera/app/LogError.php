<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class LogError extends Model
{
    protected $table='log_errores'; 
    protected $fillable = [
        'usuario_id',
        'controlador_metodo',
        'mensaje'
    ];

}
    

