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

     /**
     * obtiene la cartera asociada al usuario.
     */
    public function cartera()
    {
        return $this->hasOne('App\Cartera', 'usuario_id');
    }

     /**
     * obtiene descripcion del tipo de usuario
     */
    public function descripcion_tipo_usuario()
    {   
        switch ($this->tipo) {
            case 1:
                return 'administrador';
                break;
            case 2:
                return 'empresa';
                break;
            case 3:
                return 'carterista';
                break;
        }
    }

    /**
     * obtiene descripcion del tipo de usuario
     */
    public function correo_user()
    {   
        if(!is_null($this->user)){
            return $this->user->email;
        }
        return '';
    }






}
    

