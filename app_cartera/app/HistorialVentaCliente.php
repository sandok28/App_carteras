<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistorialVentaCliente extends Model
{

    protected $table='historial_venta_clientes';
    //
    protected $fillable = [
        'cliente_id',
        'venta',
        'deuda',
        'abono',
        'saldo'
    ];
}
