<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Devolucion;
use App\Empresa;
use App\Producto;
use App\Cartera;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Carbon\Carbon;

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
        
        $current_date = Carbon::now()->toDateString(); // Produces something like "2019-03-11"
        
        $clientes_por_atender = DB::table('clientes')->where('cartera_id',$usuario->cartera->id)->where('fecha_ultima_visita','!=',$current_date)->orderBy('posicion','asc')->get();
        
        $clientes_atendidos = DB::table('clientes')->where('cartera_id',$usuario->cartera->id)->where('fecha_ultima_visita','=',$current_date)->orderBy('posicion','asc')->get();
        
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
          
            return view('carteristas.clientes.formulario_clientes_crear');
    }


    public function clientes_crear(Request $request)
    {
        try{
            DB::beginTransaction();


            $user = Auth::user();
            $usuario = $user->usuarios->get(0);
            $current_date = Carbon::now()->toDateString(); // Produces something like "2019-03-11"
        
            $clientes_por_atender = DB::table('clientes')->where('cartera_id',$usuario->cartera->id)->where('fecha_ultima_visita','!=',$current_date)->orderBy('posicion','asc')->get();
            DB::table('clientes')->where('cartera_id',$usuario->cartera->id)->where('fecha_ultima_visita','!=',$current_date)->increment('posicion',1);
            
            //dd($clientes_por_atender);
            $cliente = new Cliente();
            $cliente->nombre = $request->input('nombre');
            $cliente->direccion = $request->input('direccion');
            $cliente->telefono = $request->input('telefono');
            $cliente->cedula = $request->input('cedula');
            $cliente->estado = 'A';
            $cliente->fecha_ultima_visita = Carbon::now()->subDays(1)->toDateString(); // Produces something like "2019-03-11"
            $cliente->posicion = $clientes_por_atender->get(0)->posicion;
            $cliente->cartera_id = $usuario->cartera->id;
            $cliente->deuda = 0;
            $cliente->intentos_sin_ventas = 0;
            $cliente->save();

            
            DB::commit(); //////->SAVE
        }
        catch (\Exception $ex){
            DB::rollback();
            dd($ex);
            

        }            

        return redirect()->route('carterista');
    }
//////////Vista venta del Cliente

    public function formulario_cliente_venta($cliente_id)
    {      
        $user = Auth::user();
        $productos = $user->usuarios->get(0)->cartera->neveras; //neveras de la cartera a la cual pertenece el usuario logueado
       
        return view('carteristas.clientes.formulario_cliente_venta')->with('productos',$productos)
                                                                    ->with('cliente_id',$cliente_id);
    
    }

    public function formulario_cliente_pagar(Request $request, $cliente_id)
    {
        try{
            DB::beginTransaction();
        
            $user = Auth::user();// Usuario carterista en sesion         
            $neveras = $user->usuarios->get(0)->cartera->neveras; //neveras de la cartera a la cual pertenece el carterista logueado
            //dd($neveras);

            $resumen_venta = new Collection();
            $resumen_venta->detalles_venta =  new Collection();
            $total_venta=0;
            foreach($neveras as $nevera){

                $cantidad_vendida = $request->input('cantidad_producto_'.$nevera->id);// obtiene la cantidad segun el producto seleccionado
                if(!is_null($cantidad_vendida)) {

                    $detalle_venta = new Collection();
                    $detalle_venta->cantidad_vendida = $cantidad_vendida;
                    $detalle_venta->subtotal_vendido = ($nevera->producto->precio)*$cantidad_vendida;
                    $detalle_venta->producto_nombre = $nevera->producto->nombre;
                    $resumen_venta->detalles_venta->push($detalle_venta);

                    $total_venta=$total_venta+($nevera->producto->precio)*$cantidad_vendida;

                    DB::table('neveras')
                    ->where('id', $nevera->id)->decrement('cantidad',$cantidad_vendida);
                }

            }
            DB::table('clientes')
              ->where('id', $cliente_id)->increment('deuda',$total_venta);
           
            $current_date = Carbon::now()->toDateString(); // Produces something like "2019-03-11"

            DB::table('clientes')
              ->where('id',  $cliente_id)->update(['fecha_ultima_visita' => $current_date]);
            $resumen_venta->total_venta = $total_venta;

            $cliente = Cliente::find($cliente_id);
            $resumen_venta->deuda_cliente = $cliente->deuda;
            $resumen_venta->cliente_id = $cliente->id;
            
            DB::commit(); //////->SAVE
        }
        catch (\Exception $ex){
            DB::rollback();
            dd($ex);
            

        }
        
        return view('carteristas.clientes.confirmar_compra')->with('resumen_venta',$resumen_venta);
    
    }

    public function gestion_cliente_cartera($cliente_id)
    {
        $cliente = Cliente::Find($cliente_id);
        return view('carteristas.gestion_cliente.gestion_cliente_cartera')->with('cliente',$cliente);//->with('deuda_cliente',$deuda_cliente);
    
    }


    public function formulario_pagar($cliente_id)
    {      
       
        $cliente = Cliente::Find($cliente_id); //neveras de la cartera a la cual pertenece el usuario logueado
     
        return view('carteristas.clientes.formulario_pagar')->with('cliente',$cliente);
    
    }
    public function recaudo(Request $request, $cliente_id)
    {      
       
        $cliente = Cliente::Find($cliente_id); //neveras de la cartera a la cual pertenece el usuario logueado
     
        DB::table('clientes')
              ->where('id', $cliente_id)->decrement('deuda',$request->pago);
        
        $current_date = Carbon::now()->toDateString(); // Produces something like "2019-03-11"
        DB::table('clientes')
            ->where('id',  $cliente_id)->update(['fecha_ultima_visita' => $current_date]);

        return redirect()->route('carterista.gestion_cliente_cartera',$cliente_id);
    }
    public function formulario_reportar_lista_negra($cliente_id)
    {      
       
        $cliente = Cliente::Find($cliente_id); //neveras de la cartera a la cual pertenece el usuario logueado
     
        return view('carteristas.clientes.reportar.formulario_reportar_lista_negra')->with('cliente',$cliente);    
    }

    public function reportar_lista_negra($cliente_id)
    {      
        $cliente = Cliente::Find($cliente_id); //neveras de la cartera a la cual pertenece el usuario logueado
     
        $user = Auth::user();
        $usuario = $user->usuarios->get(0);

        $cartera_lista_negra = Cartera::where('empresa_id',$usuario->empresa_id)->where('tipo','2')->get();//tipo=2 es carteria tipo lista negra

        DB::table('clientes')
            ->where('id',  $cliente_id)->update([   'estado' => 'LNP',//LNP -Lista negra pendiente de confirmar
                                                    'cartera_id'=> $cartera_lista_negra->get(0)->id
                                                ]);

        return redirect()->route('carterista.gestion_cliente_cartera',$cliente_id);    
    }

 }
