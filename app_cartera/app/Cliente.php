<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';
    //

    protected $fillable = [
            'cliente_id',
            'nombre',
            'direccion',
            'telefono',
            'cedula',
            'comentarios',
            'cartera_id',
            'fecha_ultima_visita',
            'posicion',
            'deuda',
            'estado'
        ];

    /**
     * obtiene la cartera a la cual pertenecen la cartera
     */
    public function cartera()
    {
        return $this->belongsTo('App\Cartera', 'cartera_id', 'id');
    }

    public function devoluciones()
        {
            return $this->hasMany('App\Devolucion', 'producto_id', 'id');
        }

 

}
