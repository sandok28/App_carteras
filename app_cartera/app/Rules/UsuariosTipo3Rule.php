<?php

namespace App\Rules;
use App\Usuario;
use App\User;

use Illuminate\Contracts\Validation\Rule;

class UsuariosTipo3Rule implements Rule
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
        
        if(is_null($value)){

            $this->message = 'El campo carterista es obligatorio';
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
