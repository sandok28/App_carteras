<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistorialVentaCartera extends Model
{
    protected $table='historial_venta_carteras';
    
    protected $fillable = [
        'cartera_id',
        'venta',
        'deuda',
        'abono',
        'saldo'

    ];
    
}
