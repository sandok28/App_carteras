<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nevera extends Model
{
    protected $table='neveras';
    protected $fillable = [
        'producto_id',
        'cantidad',
        'cartera_id'

    ];
}
