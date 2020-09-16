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


    public $algo = "Algo propio";

    /**
     * obtiene las carteras por empresa
     *  
     */
    public function carteras()
    {
        return $this->hasMany('App\Cartera', 'empresa_id', 'id');
    }

    /**
     * obtiene los productos por empresa
     *  
     */
    public function productos()
    {
        return $this->hasMany('App\Producto', 'empresa_id', 'id');
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
