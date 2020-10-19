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

    /**
     * obtiene el producto al cual pertenece la nevera
     */
    public function producto()
    {
        return $this->belongsTo('App\Producto', 'producto_id', 'id');
    }

}
