<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $fillable = [
        'nombre',
        'cedula',
        'nit',
        'telefono',
        'direccion',
        'tipo',
        'estado',
        'user_id',
        'empresa_id'
    ];



    /**
     * obtiene el user(usuario que inicia sesion) al cual pertenecen el usuario
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    /**
     * obtiene la empresa a la cual pertenecen el usuario
     */
    public function empresa()
    {
        return $this->belongsTo('App\Empresa', 'empresa_id', 'id');
    }




}
    

