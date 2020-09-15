<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $fillable = [
                            'nombre',
                            'descripcion',
                            'estado'
    ];


    /**
     * obtiene las carteras por empresa
     *  
     */
    public function carteras()
    {
        return $this->hasMany('App\Cartera', 'empresa_id', 'id');
    }

    /**
     * obtiene las usuarios por empresa
     *  
     */
    public function usuarios()
    {
        return $this->hasMany('App\Usuario', 'empresa_id', 'id');
    }


}
