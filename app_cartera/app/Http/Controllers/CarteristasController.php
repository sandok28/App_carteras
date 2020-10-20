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
//////////Vista venta del Cliente

    public function formulario_cliente_venta($cliente_id)
    {
        //dd($cliente_id);
        $user = Auth::user();
        $productos = $user->usuarios->get(0)->cartera->neveras; //neveras de la cartera a la cual pertenece el usuario logueado
        //dd($productos);
        //dd($productos->get(0)->producto->precio);
        // //dd($usuarios);

        // foreach($usuarios as $usuario){
        //     $var_aux1 =$usuario;
        //     //dd($var_aux1);
        //     $nom=$var_aux1->producto;
        //     dd($nom->nombre);}

        return view('carteristas.clientes.formulario_cliente_venta')->with('productos',$productos)
                                                                    ->with('cliente_id',$cliente_id);
    
    }

    public function formulario_cliente_pagar(Request $request, $cliente_id)
    {
        
        //dd($request);
        //dd($request->input('cantidad_producto_132'));
        $user = Auth::user();
        //$productos=Producto::where('empresa_id',$empresa_id)->get();
        $neveras = $user->usuarios->get(0)->cartera->neveras; //neveras de la cartera a la cual pertenece el usuario logueado
        $deuda_cliente=Cliente::find($cliente_id)->deuda;
        //dd($deuda_cliente->deuda);
        //dd($productos->get(0)->producto->precio);
        // dd($usuarios);
        $total=0;
        foreach($neveras as $nevera){
            $var_aux ='cantidad_producto_'.$nevera->id;
            //dd($producto->producto->precio);
            //dd($precio);

            if(!is_null($request->input($var_aux))) {
                //dd('no existe');
               
                $total=$total+($nevera->producto->precio)*$request->input($var_aux);
            } else {
                //dd('existe');
                
            }

        }
        
        return view('carteristas.clientes.confirmar_compra')->with('total',$total)->with('deuda_cliente',$deuda_cliente);
    
    }

 }
