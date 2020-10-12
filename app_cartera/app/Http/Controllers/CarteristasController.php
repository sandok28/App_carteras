<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Devolucion;
use App\Empresa;
use App\Producto;
use Auth;
use Illuminate\Http\Request;

class CarteristasController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('RolUserAdminMiddleware');
      
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function panel_central_carteristas()
    {
        $user = Auth::user();
        $usuario = $user->usuarios->get(0);
        $cartera = $usuario->cartera;
        $clientes_por_atender = $cartera->clientes;
        

        $clientes_por_atender = $cartera->clientes->where('fecha_ultima_visita','!=','2020-10-05');
        
        $clientes_atendidos = $cartera->clientes->where('fecha_ultima_visita','=','2020-10-05');
        

        return view('carteristas.panel_central_carteristas')->with('cartera',$cartera)
                                                            ->with('clientes_atendidos',$clientes_atendidos)
                                                            ->with('clientes_por_atender',$clientes_por_atender);
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function formulario_clientes_crear()
    {
           // dd('Hola');
            return view('carteristas.clientes.formulario_clientes_crear');
    }


    public function clientes_crear(Request $request)
    {
        
            $cliente = new Cliente();
            $cliente->nombre = $request->input('nombre');
            $cliente->direccion = $request->input('direccion');
            $cliente->telefono = $request->input('telefono');
            $cliente->cedula = $request->input('cedula');
            $devolucion->save();
            
            

            return redirect('/clientes');
    }

    
}
