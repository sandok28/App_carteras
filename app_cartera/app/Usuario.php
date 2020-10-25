<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use App\Cartera;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
    public function carteras()
    {
        return $this->hasMany('App\Cartera', 'usuario_id','id');
    }

     /**
     * obtiene la cartera asociada al usuario para el dia actual.
     */
    public function cartera()
    {

        $dia_id = 1;
        $current_day = Carbon::now()->dayOfWeek; // Produces something like "2019-03-11"
        
        if($current_day == 0){
            $current_day = 7;
        }
      
        foreach($this->carteras as $cartera){
            $carteras_dias = DB::table('cartera_dia')->where('cartera_id',$cartera->id)->where('dia_id',$current_day)->get()->get(0);            
            if(!is_null($carteras_dias)){
                return $cartera;
            }
        }
        return "null";
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
    

