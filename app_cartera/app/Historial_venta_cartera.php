<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Historial_venta_cartera extends Model
{
    //
    protected $fillable = [
        'cartera_id',
        'venta',
        'deuda',
        'abono',
        'saldo'

    ];
}
