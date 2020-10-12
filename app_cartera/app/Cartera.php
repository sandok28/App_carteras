<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cartera extends Model
{
    protected $fillable = [
            'nombre',
            'descripcion',
            'estado',
            'usuario_id',
            'empresa_id',
            'tipo',
            'cargue'
    ];


    /**
     * obtiene la empresa a la cual pertenecen la cartera
     */
    public function empresa()
    {
        return $this->belongsTo('App\Empresa', 'empresa_id', 'id');
    }

    /**
     * obtiene el usuario  asociado a la cartera.
     */
    public function usuario()
    {
        return $this->belongsTo('App\Usuario', 'usuario_id', 'id');
    }

    /**
     * obtiene los clientes de la cartera
     * 
     */
    public function clientes()
    {
        return $this->hasMany('App\Cliente', 'cartera_id', 'id');
    }



}
