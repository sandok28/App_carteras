<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Historial_venta_cliente extends Model
{
    //
    protected $fillable = [
        'cliente_id',
        'venta',
        'deuda',
        'abono',
        'saldo'

    ];
}
