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

    public function producto()
        {
            return $this->belongsTo('App\Producto', 'producto_id', 'id');
        }

    public function cartera()
        {
            return $this->belongsTo('App\Cartera', 'cartera_id', 'id');
        }

    public function cliente()
        {
            return $this->belongsTo('App\Cliente', 'cliente_id', 'id');
        }
}
