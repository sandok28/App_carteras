<?php

namespace App\Http\Middleware;

use Closure;
use App\Usuario;
use Illuminate\Contracts\Auth\Guard;
use Mockery\Exception;

class RolUserAdminMiddleware
{



    protected $auth;
    public function __construct(Guard $auth){
        
        $this->auth = $auth;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {

            $usuarios = Usuario::where('user_id', '=', $this->auth->user()->id)->get();
            $usuario = $usuarios->get(0);
            
            
            if(is_null($usuario))// Si el user no tiene usuario asociado
            {
                return redirect()->to('/home');
            }

            if($usuario->tipo == 1) // Es tipo 1 - Admninistrador
            {
                return $next($request);
            }
            else // No es tipo 1 - Admninistrador
            {
                return redirect()->to('/home');
            }
        }    
        catch (\Exception $ex){
            dd('Fallo',$ex);
        }
    
       
    }
}
