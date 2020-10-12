<?php

namespace App\Rules;
use App\Usuario;
use App\User;

use Illuminate\Contracts\Validation\Rule;

class CarteristasEmailRule implements Rule
{

    private $message;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    { 
        $user = User::Where('email',$value)->get()->get(0);

        if($value == ''){
            $this->message = 'Ingrese un Correo Electronico '.$value;
            return false;
        }
        else if(is_null($user))
        {
            $this->message = 'No existe usuario registrado con el correo '.$value;
            return false;
        }else if(!is_null($user->usuarios->get(0)))
        {   
            $usuario_nombre = $user->usuarios->get(0)->nombre;
            $descripcion_tipo_usuario = $user->usuarios->get(0)->descripcion_tipo_usuario();
            $this->message = 'El correo '.$value.' se encuentra asociado al usuario '.$usuario_nombre.', dicho usuario es tipo '.$descripcion_tipo_usuario;
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
