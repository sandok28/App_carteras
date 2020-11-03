<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Devolucion;
use App\Empresa;
use App\Producto;
use App\Cartera;
use App\Bono;
use App\Novedad;
use App\HistorialVentaCliente;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class CarteristasController extends Controller
{

    protected  $erroreslog;
    protected  $controller_name = 'EmpresasController.';
    public function __construct(ErroresController $erroreslog_init)
    {
        $this->middleware('auth');
        $this->middleware('RolUserCarteristaMiddleware');
        $this->erroreslog = $erroreslog_init;
      
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
        $empresa_id = $user->usuarios->get(0)->empresa_id;////// id de la empresa del usuario logueado
        $estado_usuario=$user->usuarios->get(0)->estado;// estado de el usuario logueado
        $estado_empresa=Empresa::find($empresa_id)->estado;// estado de la empresa del usuario logueado
        $cartera = $usuario->cartera();
        //dd($cartera);

        if($estado_empresa=='I' || $estado_usuario=='I'){
            return view('errores.usuario');
        }
                else{if($cartera == "null"){
                    return view('carteristas.panel_central_carteristas')->with('cartera',null)
                                                                        ->with('clientes_atendidos',null)
                                                                        ->with('clientes_por_atender',null);
                    }


                $current_date = Carbon::now()->toDateString(); // Produces something like "2019-03-11"
                
                $clientes_por_atender = DB::table('clientes')->where('cartera_id',$cartera->id)->where('fecha_ultima_visita','!=',$current_date)->orderBy('posicion','asc')->get();
                
                $clientes_atendidos = DB::table('clientes')->where('cartera_id',$cartera->id)->where('fecha_ultima_visita','=',$current_date)->orderBy('posicion','asc')->get();
                
                return view('carteristas.panel_central_carteristas')->with('cartera',$cartera)
                                                                    ->with('current_date',$current_date)
                                                                    ->with('clientes_atendidos',$clientes_atendidos)
                                                                    ->with('clientes_por_atender',$clientes_por_atender);
                }



        
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function formulario_clientes_crear()
    {
        $user = Auth::user();
        $empresa_id = $user->usuarios->get(0)->empresa_id;////// id de la empresa del usuario logueado
        $estado_usuario=$user->usuarios->get(0)->estado;// estado de el usuario logueado
        $estado_empresa=Empresa::find($empresa_id)->estado;// estado de la empresa del usuario logueado

        if($estado_empresa=='I' || $estado_usuario=='I'){
                    return view('errores.usuario');
                }
                else{return view('carteristas.clientes.formulario_clientes_crear');}   
            }


    public function clientes_crear(Request $request)
    {

        $validatedData = $request->validate([
            'nombre' => 'required',
            'direccion' => 'required'
            ]);
        try{
            DB::beginTransaction();


            $user = Auth::user();
            $usuario = $user->usuarios->get(0);
            $current_date = Carbon::now()->toDateString(); // Produces something like "2019-03-11"
        
            
          
            // Validar si cliente esta en lista negra
        
                      
            $empresa_id = $user->usuarios->get(0)->empresa_id;////// id de la empresa del usuario logueado
            $cartera_LNC_id = Cartera::where('empresa_id',$empresa_id)->where('tipo','2')->get()->get(0)->id;
            $cartera_LI_id = Cartera::where('empresa_id',$empresa_id)->where('tipo','3')->get()->get(0)->id;
            $clientes_listanegra_telefono = Cliente::where('estado','LNC')
                                        ->where('cartera_id',$cartera_LNC_id)
                                        ->where(   
                                                'telefono',(is_null($request->input('telefono')) ? '-1' : $request->input('telefono'))
                                                )                                        
                                        ->get();
           

            if(!$clientes_listanegra_telefono->isEmpty()){ //cliente existe en lista negra por telefono
                $cliente=$clientes_listanegra_telefono->first();
                //dd($cliente);
                return view('carteristas.clientes.cliente_lnT')->with('cliente',$cliente)->with(['message'=> 'Cliente reportado en lista negra con numero de telefono','tipo'=>'error']);
                //dd($clientes_listanegra_telefono, $request->input('telefono'),'aaa');
                //poner parametro tipo por el que fallo --  si fue por telefono o cedula
            }


            $clientes_listanegra_cedula = Cliente::where('estado','LNC')
                                        ->where('cartera_id',$cartera_LNC_id)
                                        ->where(   
                                                'cedula',(is_null($request->input('cedula')) ? '-1' : $request->input('cedula'))
                                                )
                                        ->get();
           

            if(!$clientes_listanegra_cedula->isEmpty()){ //cliente existe en lista negra por telefono
                $cliente=$clientes_listanegra_cedula->first();
    
                return view('carteristas.clientes.cliente_lnC')->with('cliente',$cliente)->with(['message'=> 'Cliente reportado en lista negra con numero de cedula','tipo'=>'error']);
                //dd($clientes_listanegra_cedula, $request->input('telefono'),'aaa');
                //poner parametro tipo por el que fallo --  si fue por telefono o cedula
            }

            /////////////////////////////////////

            $clientes_inactivos_cedula = Cliente::where('estado','LIP')
                                        ->where('cartera_id',$cartera_LI_id)
                                        ->where(   
                                                'cedula',(is_null($request->input('cedula')) ? '-1' : $request->input('cedula'))
                                                )
                                        ->get();
           

            if(!$clientes_inactivos_cedula->isEmpty()){ //cliente existe en lista negra por telefono
                $cliente=$clientes_inactivos_cedula->first();
    
                return view('carteristas.clientes.cliente_li')->with('cliente',$cliente)->with(['message'=> 'Cliente desactivado con numero de cedula','tipo'=>'error']);
                //dd($clientes_listanegra_cedula, $request->input('telefono'),'aaa');
                //poner parametro tipo por el que fallo --  si fue por telefono o cedula
            }

            //////////////////////////////////////////
            $clientes_inactivos_telefono = Cliente::where('estado','LIP')
                                        ->where('cartera_id',$cartera_LI_id)
                                        ->where(   
                                                'telefono',(is_null($request->input('telefono')) ? '-1' : $request->input('telefono'))
                                                )
                                        ->get();
           

            if(!$clientes_inactivos_telefono->isEmpty()){ //cliente existe en lista negra por telefono
                $cliente=$clientes_inactivos_telefono->first();
    
                return view('carteristas.clientes.cliente_li')->with('cliente',$cliente)->with(['message'=> 'Cliente desactivado con numero de telefono','tipo'=>'error']);
                //dd($clientes_listanegra_cedula, $request->input('telefono'),'aaa');
                //poner parametro tipo por el que fallo --  si fue por telefono o cedula
            }

            






            // Validar si clienmte esta en lista inactivo
            


















        
            //crea cliente

            
            $clientes_por_atender = DB::table('clientes')->where('cartera_id',$usuario->cartera()->id)->where('fecha_ultima_visita','!=',$current_date)->orderBy('posicion','asc')->get();
            DB::table('clientes')->where('cartera_id',$usuario->cartera()->id)->where('fecha_ultima_visita','!=',$current_date)->increment('posicion',1);
            
        
            $cliente = new Cliente();
            $cliente->nombre = $request->input('nombre');
            $cliente->direccion = $request->input('direccion');
            $cliente->telefono = is_null($request->input('telefono')) ? '' : $request->input('telefono');
            $cliente->cedula = is_null($request->input('cedula')) ? '' : $request->input('cedula');
            $cliente->estado = 'A';
            $cliente->fecha_ultima_visita = Carbon::now()->subDays(1)->toDateString(); // Produces something like "2019-03-11"
            $cliente->posicion = ($clientes_por_atender->isEmpty() ? '1': $clientes_por_atender->get(0)->posicion);
            $cliente->cartera_id = $usuario->cartera()->id;
            $cliente->deuda = 0;
            $cliente->intentos_sin_ventas = 0;
            $cliente->save();
                
  


            


            //dd($clientes_por_atender);
            
            
            DB::commit(); //////->SAVE
        }
        catch (\Exception $ex){dd($ex);
            DB::rollback();
            $user = Auth::user();
            $usuario = $user->usuarios->get(0)->id;
            $this->erroreslog->registrarerrores($usuario,$this->controller_name.'clientes_crear',$ex->getMessage());            
            return redirect()->route('carterista.clientes.formulario_clientes_crear')->with(['message'=> 'Error al crear el cliente ','tipo'=>'error']);
            
        }            

        return redirect()->route('carterista')->with(['message'=> 'Operacion exitosa ','tipo'=>'message']);
    }

/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function formulario_clientes_actualizar($cliente_id)
    {
        $user = Auth::user();
        $empresa_id = $user->usuarios->get(0)->empresa_id;////// id de la empresa del usuario logueado
        $estado_usuario=$user->usuarios->get(0)->estado;// estado de el usuario logueado
        $estado_empresa=Empresa::find($empresa_id)->estado;// estado de la empresa del usuario logueado
        $cliente = Cliente::Find($cliente_id);

        if($estado_empresa=='I' || $estado_usuario=='I'){
                    return view('errores.usuario');
                }
                else{return view('carteristas.clientes.formulario_clientes_actualizar')->with('cliente',$cliente);}
                
                
    }


    public function clientes_actualizar(Request $request, $cliente_id)
    {
        $validatedData = $request->validate([
            'nombre' => 'required',
            'direccion' => 'required'
            ]);
        try{
            DB::beginTransaction();

            $cliente = Cliente::Find($cliente_id);

            if(is_null($request->estado)){
                
                $cliente->nombre = $request->input('nombre');
                $cliente->direccion = $request->input('direccion');
                $cliente->telefono = is_null($request->input('telefono')) ? '' : $request->input('telefono');
                $cliente->cedula = is_null($request->input('cedula')) ? '' : $request->input('cedula');            
                $cliente->save();
            }else{
               
                $user = Auth::user();
                $usuario = $user->usuarios->get(0);        
                $cartera_lista_inactivo = Cartera::where('empresa_id',$usuario->empresa_id)->where('tipo','3')->get();//tipo=3 es cartera tipo lista inactivo
        

                DB::table('clientes')->where('cartera_id',$usuario->cartera()->id)->where('posicion','>',$cliente->posicion)->decrement('posicion',1);

                DB::table('clientes')
                    ->where('id',  $cliente_id)->update([   'estado' => 'LIP',//LIP -Lista Inactivo pendiente de confirmar
                                                            'cartera_id'=> $cartera_lista_inactivo->get(0)->id
                                                        ]);
            }
                        
            
            DB::commit(); //////->SAVE
        }
        catch (\Exception $ex){
            DB::rollback();
            $user = Auth::user();
            $usuario = $user->usuarios->get(0)->id;
            $this->erroreslog->registrarerrores($usuario,$this->controller_name.'clientes_actualizar',$ex->getMessage());            
            return redirect()->route('carterista.clientes.formulario_clientes_actualizar')->with(['message'=> 'Error al actualizar el cliente ','tipo'=>'error']);
            

        }            

        return redirect()->route('carterista')->with(['message'=> 'Operacion exitosa ','tipo'=>'message']);
    }

    //Vista venta del Cliente
    public function regHistorialCliente($cliente_id, $venta, $abono)
    {      
        //dd($cliente_id, $venta, $abono,'historial');
        $cliente = Cliente::Find($cliente_id); //neveras de la cartera a la cual pertenece el usuario logueado
     
        $current_date = Carbon::now()->toDateString(); // Produces something like "2019-03-11"
        $reg_historial_cliente = DB::table('historial_venta_clientes')
                                    ->where('cliente_id',$cliente_id)
                                    ->where('fecha',$current_date)->get();
                  
                                    
        if($reg_historial_cliente->isEmpty()){           
            $historial_cliente = new HistorialVentaCliente();
            $historial_cliente->cliente_id = $cliente_id;
            $historial_cliente->fecha = $current_date;
            $historial_cliente->venta = $venta;
            $historial_cliente->deuda = $cliente->deuda;
            $historial_cliente->abono = $abono;
            $historial_cliente->saldo = ($cliente->deuda + $venta) - $abono;
            $historial_cliente->save();
        }else{
            
           DB::table('historial_venta_clientes')
                ->where('cliente_id',$cliente_id)->where('fecha',$current_date)
                ->increment('venta',$venta);
           DB::table('historial_venta_clientes')
                ->where('cliente_id',$cliente_id)->where('fecha',$current_date)
                ->increment('abono',$abono);
                
            // $deuda=DB::table('historial_venta_clientes')
            //             ->where('cliente_id',$cliente_id)->where('fecha',$current_date)->get()->get(0)->deuda;
            // $venta1=DB::table('historial_venta_clientes')
            //             ->where('cliente_id',$cliente_id)->where('fecha',$current_date)->get()->get(0)->venta;
            // //dd($deuda,$venta1,$abono);
            DB::table('historial_venta_clientes')
                ->where('cliente_id',$cliente_id)->where('fecha',$current_date)
                //dd($abono, $venta,$deuda);
                ->decrement('saldo',($abono));
        }    
    }

    public function formulario_cliente_venta($cliente_id)
    {      
        
        $user = Auth::user();
        $productos = $user->usuarios->get(0)->cartera()->neveras; //neveras de la cartera a la cual pertenece el usuario logueado
        $empresa_id = $user->usuarios->get(0)->empresa_id;////// id de la empresa del usuario logueado
        $estado_usuario=$user->usuarios->get(0)->estado;// estado de el usuario logueado
        $estado_empresa=Empresa::find($empresa_id)->estado;// estado de la empresa del usuario logueado

        if($estado_empresa=='I' || $estado_usuario=='I'){
                    return view('errores.usuario');
                }
                else{return view('carteristas.clientes.formulario_cliente_venta')->with('productos',$productos)
                    ->with('cliente_id',$cliente_id);}
    
    }

    public function formulario_cliente_pagar(Request $request, $cliente_id)
    {
        
        try{
            DB::beginTransaction();
        
            $user = Auth::user();// Usuario carterista en sesion         
            $neveras = $user->usuarios->get(0)->cartera()->neveras; //neveras de la cartera a la cual pertenece el carterista logueado
            $empresa_id = $user->usuarios->get(0)->empresa_id;////// id de la empresa del usuario logueado
            $estado_usuario=$user->usuarios->get(0)->estado;// estado de el usuario logueado
            $estado_empresa=Empresa::find($empresa_id)->estado;// estado de la empresa del usuario logueado
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
            $this->regHistorialCliente( $cliente_id, $total_venta, 0);
            
            DB::table('clientes')
              ->where('id', $cliente_id)->increment('deuda',$total_venta);
           
            $current_date = Carbon::now()->toDateString(); // Produces something like "2019-03-11"

            DB::table('clientes')
              ->where('id',  $cliente_id)->update(['fecha_ultima_visita' => $current_date]);
            $resumen_venta->total_venta = $total_venta;

            
            $cliente = Cliente::find($cliente_id);
            $resumen_venta->deuda_cliente = $cliente->deuda;
            $resumen_venta->cliente_id = $cliente->id;
            
            DB::table('carteras')
                ->where('id', $cliente->cartera->id)->increment('venta_del_dia',$total_venta);
            DB::table('carteras')
                ->where('id', $cliente->cartera->id)->increment('saldo_del_dia',$total_venta);

            
            DB::commit(); //////->SAVE
        }
        catch (\Exception $ex){
            DB::rollback();
            $user = Auth::user();
            $usuario = $user->usuarios->get(0)->id;
            $this->erroreslog->registrarerrores($usuario,$this->controller_name.'formulario_cliente_pagar',$ex->getMessage());            
            return redirect()->route('carterista.gestion_cliente_cartera')->with(['message'=> 'Error al efectuar la operacion ','tipo'=>'error']);
            

        }

        
        if($estado_empresa=='I' || $estado_usuario=='I'){
            return view('errores.usuario');
        }
        else{return view('carteristas.clientes.confirmar_compra')->with('resumen_venta',$resumen_venta)->with(['message'=> 'Operacion exitosa ','tipo'=>'message']);}
        
        
    
    }

    public function gestion_cliente_cartera($cliente_id)
    {
        $user = Auth::user();
        $empresa_id = $user->usuarios->get(0)->empresa_id;////// id de la empresa del usuario logueado
        $estado_usuario=$user->usuarios->get(0)->estado;// estado de el usuario logueado
        $estado_empresa=Empresa::find($empresa_id)->estado;// estado de la empresa del usuario logueado
        $cliente = Cliente::Find($cliente_id);

        
        if($estado_empresa=='I' || $estado_usuario=='I'){
            return view('errores.usuario');
        }
        else{return view('carteristas.gestion_cliente.gestion_cliente_cartera')->with('cliente',$cliente);}//->with('deuda_cliente',$deuda_cliente);
        
    
    }


    public function formulario_pagar($cliente_id)
    {      
        $user = Auth::user();
        $empresa_id = $user->usuarios->get(0)->empresa_id;////// id de la empresa del usuario logueado
        $estado_usuario=$user->usuarios->get(0)->estado;// estado de el usuario logueado
        $estado_empresa=Empresa::find($empresa_id)->estado;// estado de la empresa del usuario logueado
        $cliente = Cliente::Find($cliente_id); //neveras de la cartera a la cual pertenece el usuario logueado
        
        if($estado_empresa=='I' || $estado_usuario=='I'){
            return view('errores.usuario');
        }
        else{return view('carteristas.clientes.formulario_pagar')->with('cliente',$cliente);}  
    
    }
    public function recaudo(Request $request, $cliente_id)
    {     
        
        $validatedData = $request->validate([
            'pago' => 'required'
            ]);
        try{
            DB::beginTransaction();

            $cliente = Cliente::Find($cliente_id); //neveras de la cartera a la cual pertenece el usuario logueado
        
            //dd($cliente->deuda);
            DB::table('clientes')
                ->where('id', $cliente_id)->decrement('deuda',$request->pago);
            
            $current_date = Carbon::now()->toDateString(); // Produces something like "2019-03-11"
            DB::table('clientes')
                ->where('id',  $cliente_id)->update(['fecha_ultima_visita' => $current_date]);
                
            DB::table('carteras')
                ->where('id', $cliente->cartera->id)->increment('abono_del_dia',$request->pago);
            DB::table('carteras')
                ->where('id', $cliente->cartera->id)->decrement('saldo_del_dia',$request->pago);
                
            $this->regHistorialCliente($cliente_id, 0, $request->pago);
            //dd('recaudo',$cliente_id, 0, $request->pago);
            DB::commit(); //////->SAVE
        }
        catch (\Exception $ex){
            DB::rollback();
            $user = Auth::user();
            $usuario = $user->usuarios->get(0)->id;
            $this->erroreslog->registrarerrores($usuario,$this->controller_name.'recaudo',$ex->getMessage());            
            return redirect()->route('carterista.cliente.formulario_pagar')->with(['message'=> 'Error al efectuar la operacion ','tipo'=>'error']);
            

        }
        return redirect()->route('carterista.gestion_cliente_cartera',$cliente_id)->with(['message'=> 'Operacion exitosa ','tipo'=>'message']);
    }
    public function formulario_reportar_lista_negra($cliente_id)
    {      
        $user = Auth::user();
        $empresa_id = $user->usuarios->get(0)->empresa_id;////// id de la empresa del usuario logueado
        $estado_usuario=$user->usuarios->get(0)->estado;// estado de el usuario logueado
        $estado_empresa=Empresa::find($empresa_id)->estado;// estado de la empresa del usuario logueado
        $cliente = Cliente::Find($cliente_id); //neveras de la cartera a la cual pertenece el usuario logueado
        
        if($estado_empresa=='I' || $estado_usuario=='I'){
            return view('errores.usuario');
        }
        else{return view('carteristas.clientes.reportar.formulario_reportar_lista_negra')->with('cliente',$cliente);}
            
    }

    public function reportar_lista_negra(Request $request,$cliente_id)
    {   
        
        $cliente = Cliente::Find($cliente_id); //neveras de la cartera a la cual pertenece el usuario logueado
     
        $user = Auth::user();
        $usuario = $user->usuarios->get(0);

        $cartera_lista_negra = Cartera::where('empresa_id',$usuario->empresa_id)->where('tipo','2')->get();//tipo=2 es carteria tipo lista negra


        DB::table('clientes')->where('cartera_id',$usuario->cartera()->id)->where('posicion','>',$cliente->posicion)->decrement('posicion',1);

        DB::table('clientes')
            ->where('id',  $cliente_id)->update([   'estado' => 'LNP',//LNP -Lista negra pendiente de confirmar
                                                    'cartera_id'=> $cartera_lista_negra->get(0)->id,
                                                    'comentarios' => $request->comentarios
                                                ]);

        return redirect()->route('carterista')->with(['message'=> 'Operacion exitosa ','tipo'=>'message']);    
    }

    public function formulario_bono_crear()
    {      

        $user = Auth::user();
        $cartera_id = $user->usuarios->get(0)->cartera()->id;
        $current_date = Carbon::now()->toDateString(); // Produces something like "2019-03-11"
        $cartera_bono_del_dia = DB::table('bonos')
                                    ->where('cartera_id',$cartera_id)
                                    ->where('tipo','1')
                                    ->where('mi_fecha',$current_date)->get();
                  
                                    
        if($cartera_bono_del_dia->isEmpty()){     
            $bono = new Bono();
            
        } else{
            $bono = Bono::Find($cartera_bono_del_dia->get(0)->id);
        }
        
        return view('carteristas.bonos.formulario_bono_crear')->with('bono',$bono);    
    }

    public function bono_crear(Request $request)
    {      
        $validatedData = $request->validate([
            'descripcion' => 'required',
            'valor' => 'required'
            ]);
        $user = Auth::user();
        $cartera_id = $user->usuarios->get(0)->cartera()->id;

        $current_date = Carbon::now()->toDateString(); // Produces something like "2019-03-11"
        $cartera_bono_del_dia = DB::table('bonos')
                                    ->where('cartera_id',$cartera_id)
                                    ->where('tipo','1')
                                    ->where('mi_fecha',$current_date)->get();
                  
                                    
        if($cartera_bono_del_dia->isEmpty()){     
            $bono = new Bono();
            $bono->cartera_id = $cartera_id;
            $bono->descripcion = $request->descripcion;
            $bono->valor = $request->valor;
            $bono->mi_fecha = $current_date;
            $bono->tipo = '1';
            $bono->save();
        } else{
            $bono = Bono::find($cartera_bono_del_dia->get(0)->id);
            $bono->descripcion = $request->descripcion;
            $bono->valor = $request->valor;
            $bono->save();
        }
       
        return  redirect()->route('carterista')->with(['message'=> 'Operacion exitosa ','tipo'=>'message']);    
    }

    public function formulario_novedad_crear()
    {      
        $user = Auth::user();
        $cartera_id = $user->usuarios->get(0)->cartera()->id;
        $current_date = Carbon::now()->toDateString(); // Produces something like "2019-03-11"
        $cartera_novedad_del_dia = DB::table('novedades')
                                    ->where('cartera_id',$cartera_id)
                                    ->where('mi_fecha',$current_date)->get();
                  
                              
        if($cartera_novedad_del_dia->isEmpty()){     
            $novedad = new Novedad();
            
        } else{
            $novedad = Novedad::Find($cartera_novedad_del_dia->get(0)->id);
        }
        
        return view('carteristas.novedades.formulario_novedad_crear')->with('novedad',$novedad);    
    }

    public function novedad_crear(Request $request)
    {      
        $validatedData = $request->validate([
            'novedad' => 'required'
            ]);
        $user = Auth::user();
        $cartera_id = $user->usuarios->get(0)->cartera()->id;

        $current_date = Carbon::now()->toDateString(); // Produces something like "2019-03-11"
        $cartera_novedad_del_dia = DB::table('novedades')
                                    ->where('cartera_id',$cartera_id)
                                    ->where('mi_fecha',$current_date)->get();
                  
                                    
        if($cartera_novedad_del_dia->isEmpty()){     
            $novedad = new Novedad();
            $novedad->cartera_id = $cartera_id;
            $novedad->novedad = $request->novedad;
            $novedad->usuario_nombre = $user->usuarios->get(0)->nombre;
            $novedad->mi_fecha = $current_date;
            $novedad->save();
        } else{
            $novedad = Novedad::find($cartera_novedad_del_dia->get(0)->id);
            $novedad->novedad = $request->novedad;
            $novedad->usuario_nombre = $user->usuarios->get(0)->nombre;
            $novedad->save();
        }
       
        return  redirect()->route('carterista')->with(['message'=> 'Operacion exitosa ','tipo'=>'message']);    
    }



    public function formulario_clientes_ordenar()
    {      
        $user = Auth::user();
        $usuario = $user->usuarios->get(0);
        $cartera = $usuario->cartera();
        $empresa_id = $user->usuarios->get(0)->empresa_id;////// id de la empresa del usuario logueado
        $estado_usuario=$user->usuarios->get(0)->estado;// estado de el usuario logueado
        $estado_empresa=Empresa::find($empresa_id)->estado;// estado de la empresa del usuario logueado
        
        $current_date = Carbon::now()->toDateString(); // Produces something like "2019-03-11"
        
        $clientes = DB::table('clientes')->where('cartera_id',$cartera->id)->orderBy('posicion','asc')->get();
     
        if($estado_empresa=='I' || $estado_usuario=='I'){
            return view('errores.usuario');
        }
        else{return view('carteristas.clientes.ordenar.formulario_clientes_ordenar')->with('clientes',$clientes)->with('cartera',$cartera);}
             
    }

    public function clientes_ordenar(Request $request)
    {      
      

        try{
            DB::beginTransaction();
            $user = Auth::user();// Usuario carterista en sesion         
            $cartera_clientes = $user->usuarios->get(0)->cartera()->clientes; //neveras de la cartera a la cual pertenece el carterista logueado
            //dd($neveras);

            foreach($cartera_clientes as $cliente){

                $nueva_posicion = $request->input('cliente_posicion_'.$cliente->id);// obtiene la cantidad segun el producto seleccionado
                if(!is_null($nueva_posicion)) {
                    DB::table('clientes')
                    ->where('id', $cliente->id)->update(['posicion' => $nueva_posicion]);
                }

            }
            DB::commit(); //////->SAVE
        }
        catch (\Exception $ex){
            DB::rollback();
            $user = Auth::user();
            $usuario = $user->usuarios->get(0)->id;
            $this->erroreslog->registrarerrores($usuario,$this->controller_name.'clientes_ordenar',$ex->getMessage());            
            return redirect()->route('carterista.clientes.formulario_clientes_ordenar')->with(['message'=> 'Error al ordenar los clientes ','tipo'=>'error']);           

        }
       
        return  redirect()->route('carterista')->with(['message'=> 'Operacion exitosa ','tipo'=>'message']);    
    }

    public function formulario_devolucion_crear($cliente_id)
    {      
        $user = Auth::user();
        $cliente = Cliente::find($cliente_id);
        $productos = $user->usuarios->get(0)->empresa->productos->pluck('nombre','id'); // Produces something like "2019-03-11"
        $empresa_id = $user->usuarios->get(0)->empresa_id;////// id de la empresa del usuario logueado
        $estado_usuario=$user->usuarios->get(0)->estado;// estado de el usuario logueado
        $estado_empresa=Empresa::find($empresa_id)->estado;// estado de la empresa del usuario logueado
       
        
        if($estado_empresa=='I' || $estado_usuario=='I'){
            return view('errores.usuario');
        }
        else{return view('carteristas.clientes.devolucion.formulario_cliente_devolucion')->with('cliente',$cliente)
            ->with('productos',$productos);}
                    
    }

    public function devolucion_crear(Request $request, $cliente_id)
    {      
        $validatedData = $request->validate([            
            'producto_devuelto_id' => 'required',
            'producto_devuelto_cantidad' => 'required',            
            'producto_entregado_id' => 'required',
            'producto_entregado_cantidad' => 'required'
            ]);
        try{
            DB::beginTransaction();
            $user = Auth::user();
            $cartera_id = $user->usuarios->get(0)->cartera()->id;
            $empres_id = $user->usuarios->get(0)->empresa_id;
            $current_date = Carbon::now()->toDateString(); // Produces something like "2019-03-11"
                                        
            $devolucion= new Devolucion();
            $devolucion->cartera_id = $cartera_id;
            $devolucion->empresa_id = $empres_id;
            $devolucion->cliente_id = $cliente_id;
            $devolucion->fecha = $current_date;
            $devolucion->producto_id = $request->producto_devuelto_id;
            $devolucion->producto_cantidad =  $request->producto_devuelto_cantidad;

            $devolucion->save();

            DB::table('neveras')->where('producto_id', $request->producto_entregado_id)
                                ->where('cartera_id', $cartera_id)
                                ->decrement('cantidad',$request->producto_entregado_cantidad);
                                
            DB::commit(); //////->SAVE
        }
        catch (\Exception $ex){
            DB::rollback();
            $user = Auth::user();
            $usuario = $user->usuarios->get(0)->id;
            $this->erroreslog->registrarerrores($usuario,$this->controller_name.'devolucion_crear',$ex->getMessage());            
            return redirect()->route('carterista.devolucion.formulario_devolucion_crear')->with(['message'=> 'Error al efectuar la operacion ','tipo'=>'error']);
            
        }
        return redirect()->route('carterista.gestion_cliente_cartera',$cliente_id)->with(['message'=> 'Operacion exitosa ','tipo'=>'message']);           
    }

    public function formulario_almuerzo_crear()
    {      

        $user = Auth::user();
        $cartera_id = $user->usuarios->get(0)->cartera()->id;
        $current_date = Carbon::now()->toDateString(); // Produces something like "2019-03-11"
        $cartera_bono_del_dia = DB::table('bonos')
                                    ->where('cartera_id',$cartera_id)
                                    ->where('tipo','2')
                                    ->where('mi_fecha',$current_date)->get();
                  
                                    
        if($cartera_bono_del_dia->isEmpty()){     
            $bono = new Bono();
            
        } else{
            $bono = Bono::Find($cartera_bono_del_dia->get(0)->id);
        }
        
        return view('carteristas.almuerzos.formulario_almuerzo_crear')->with('bono',$bono);    
    }

    public function almuerzo_crear(Request $request)
    {      
        $validatedData = $request->validate([
            'descripcion' => 'required',
            'valor' => 'required'
            ]);
        $user = Auth::user();
        $cartera_id = $user->usuarios->get(0)->cartera()->id;

        $current_date = Carbon::now()->toDateString(); // Produces something like "2019-03-11"
        $cartera_bono_del_dia = DB::table('bonos')
                                    ->where('cartera_id',$cartera_id)
                                    ->where('tipo','2')
                                    ->where('mi_fecha',$current_date)->get();
                  
                                    
        if($cartera_bono_del_dia->isEmpty()){     
            $bono = new Bono();
            $bono->cartera_id = $cartera_id;
            $bono->descripcion = $request->descripcion;
            $bono->valor = $request->valor;
            $bono->mi_fecha = $current_date;
            $bono->tipo = '2';
            $bono->save();
        } else{
            $bono = Bono::find($cartera_bono_del_dia->get(0)->id);
            $bono->descripcion = $request->descripcion;
            $bono->valor = $request->valor;
            $bono->save();
        }
       
        return  redirect()->route('carterista')->with(['message'=> 'Operacion exitosa ','tipo'=>'message']);    
    }

    ////////////////////////

    public function formulario_gasto_crear()
    {      

        $user = Auth::user();
        $cartera_id = $user->usuarios->get(0)->cartera()->id;
        $current_date = Carbon::now()->toDateString(); // Produces something like "2019-03-11"
        $cartera_bono_del_dia = DB::table('bonos')
                                    ->where('cartera_id',$cartera_id)
                                    ->where('tipo','3')
                                    ->where('mi_fecha',$current_date)->get();
                  
                                    
        if($cartera_bono_del_dia->isEmpty()){     
            $bono = new Bono();
            
        } else{
            $bono = Bono::Find($cartera_bono_del_dia->get(0)->id);
        }
        
        return view('carteristas.gastos.formulario_gasto_crear')->with('bono',$bono);    
    }

    public function gasto_crear(Request $request)
    {      
        $validatedData = $request->validate([
            'descripcion' => 'required',
            'valor' => 'required'
            ]);
        $user = Auth::user();
        $cartera_id = $user->usuarios->get(0)->cartera()->id;

        $current_date = Carbon::now()->toDateString(); // Produces something like "2019-03-11"
        $cartera_bono_del_dia = DB::table('bonos')
                                    ->where('cartera_id',$cartera_id)
                                    ->where('tipo','3')
                                    ->where('mi_fecha',$current_date)->get();
                  
                                    
        if($cartera_bono_del_dia->isEmpty()){     
            $bono = new Bono();
            $bono->cartera_id = $cartera_id;
            $bono->descripcion = $request->descripcion;
            $bono->valor = $request->valor;
            $bono->mi_fecha = $current_date;
            $bono->tipo = '3';
            $bono->save();
        } else{
            $bono = Bono::find($cartera_bono_del_dia->get(0)->id);
            $bono->descripcion = $request->descripcion;
            $bono->valor = $request->valor;
            $bono->save();
        }
       
        return  redirect()->route('carterista')->with(['message'=> 'Operacion exitosa ','tipo'=>'message']);    
    }


    public function resumen_del_dia()
    {   
        
        $user = Auth::user();
        $usuario = $user->usuarios->get(0);
        $cartera = $usuario->cartera();
        $creditoinicial=$cartera->credito_del_dia;
        $cartera_id=$cartera->id;
        $current_date = Carbon::now()->toDateString(); // Produces something like "2019-03-11"
        $saldo=$cartera->saldo_del_dia;
        $venta=$cartera->venta_del_dia;
        $abono=$cartera->abono_del_dia;
        

        if(is_null($bonos=Bono::where('cartera_id',$cartera_id)->where('tipo',1)->where('mi_fecha',$current_date)->first())){
                
            $bonos = 0;
            
        }else{$bonos=Bono::where('cartera_id',$cartera_id)->where('tipo',1)->where('mi_fecha',$current_date)->first()->valor;}
        
        if(is_null($almuerzos=Bono::where('cartera_id',$cartera_id)->where('tipo',2)->where('mi_fecha',$current_date)->first())){
            
            $almuerzos = 0;
            
        }else{$almuerzos=Bono::where('cartera_id',$cartera_id)->where('tipo',2)->where('mi_fecha',$current_date)->first()->valor;}

        if(is_null($gastos=Bono::where('cartera_id',$cartera_id)->where('tipo',3)->where('mi_fecha',$current_date)->first())){
            
            $gastos = 0;
            
        }else{$gastos=Bono::where('cartera_id',$cartera_id)->where('tipo',3)->where('mi_fecha',$current_date)->first()->valor;}     
        //dd($abono);
        $total=$abono-($gastos+$almuerzos+$bonos);
        //dd($total);
        //dd($creditoinicial,$saldo,$venta,$abono);

        return view('carteristas.resumen_del_dia')->with('creditoinicial',$creditoinicial)->with('saldo',$saldo)->with('venta',$venta)->with('abono',$abono)->with('total',$total); 
    }

    public function historial_cliente($cliente_id)
    {
        $user = Auth::user();
        $empresa_id = $user->usuarios->get(0)->empresa_id;////// id de la empresa del usuario logueado
        $estado_empresa=Empresa::find($empresa_id)->estado;// estado de la empresa del usuario logueado
        //dd($cliente_id);
        $transacciones=HistorialVentaCliente::where('cliente_id',$cliente_id)->orderBy('fecha','desc')->latest()->take(5)->get(); 
        
        //dd($cartera_id);
        //dd($transacciones);
        if($estado_empresa=='I'){
            return view('errores.empresa');
        }
        else{return view('carteristas.clientes.carterista_cliente_ventas')->with('transacciones',$transacciones)
            ->with('cliente_id',$cliente_id);}  
          
    }

    public function cliente_atendido($cliente_id)
    {
        $user = Auth::user();
        $empresa_id = $user->usuarios->get(0)->empresa_id;////// id de la empresa del usuario logueado
        $estado_empresa=Empresa::find($empresa_id)->estado;// estado de la empresa del usuario logueado
        //dd($cliente_id);
        $current_date = Carbon::now()->toDateString(); // Produces something like "2019-03-11"

            DB::table('clientes')
              ->where('id',  $cliente_id)->update(['fecha_ultima_visita' => $current_date]); 
        
        //dd($cartera_id);
        //dd($transacciones);
        if($estado_empresa=='I'){
            return view('errores.empresa');
        }
        else{return  redirect()->route('carterista');}  
          
    }

    public function activar_cliente($cliente_id)
    {
        $user = Auth::user();
        $usuario = $user->usuarios->get(0);
        $cliente=Cliente::where('id',$cliente_id)->first();
        $cartera_id=$usuario->cartera()->id;
        $current_date = Carbon::now()->toDateString(); // Produces something like "2019-03-11"
        $clientes_por_atender = DB::table('clientes')->where('cartera_id',$usuario->cartera()->id)->where('fecha_ultima_visita','!=',$current_date)->orderBy('posicion','asc')->get();
        DB::table('clientes')->where('cartera_id',$usuario->cartera()->id)->where('fecha_ultima_visita','!=',$current_date)->increment('posicion',1);

        $affected = DB::update('update clientes set estado = ? where id = ?', ['A',$cliente_id]);
        $affected = DB::update('update clientes set cartera_id = ? where id = ?', [$cartera_id,$cliente_id]);
        $affected = DB::update('update clientes set posicion = ? where id = ?', [($clientes_por_atender->isEmpty() ? '1': $clientes_por_atender->get(0)->posicion),$cliente_id]);

        return  redirect()->route('carterista');
        
    }
 }
