<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bono extends Model
{
    protected $table='bonos';
    protected $fillable = [
    
        'cartera_id',
        'descripcion',
        'fecha',
        'valor'
        
];
}
