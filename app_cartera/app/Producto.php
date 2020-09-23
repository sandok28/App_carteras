<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    //
    protected $fillable = [
        'nombre',
        'precio',
        'cantidad',
        'descripcion',
        'estado',
        'usuario_id',
        'empresa_id'
];

        public function devoluciones()
        {
            return $this->hasMany('App\Devolucion', 'producto_id', 'id');
        }

}
