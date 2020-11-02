<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    //
    protected $table='cuentas';
    
    protected $fillable = [
        'cartera_id',
        'fecha',
        'cargue',
        'abono',
        'bono',
        'almuerzo',
        'gasto',
        'descargue',
        'total'

    ];

    /**
     * obtiene la cuenta a la cual pertenecen la cartera
     */
    public function cartera()
    {
        return $this->belongsTo('App\Cartera', 'cartera_id', 'id');
    }
}
