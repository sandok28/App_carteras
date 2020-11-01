<?php

namespace App\Http\Controllers;

use Auth;
use App\Cartera;
use App\Bono;
use App\Producto;
use App\Nevera;
use App\Cliente;
use App\Empresa;
use App\Devolucion;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class GestionBodegaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('RolUserAdminMiddleware');
      
    }
    
    public function panel_central_bodega()
    {

        $user = Auth::user();
        $empresa_id = $user->usuarios->get(0)->empresa_id;////// id de la empresa del usuario logueado
        //$carteras = Cartera::where('empresa_id',$empresa_id);////// carteras de la empresa del usuario logueado
        $estado_empresa=Empresa::find($empresa_id)->estado;// estado de la empresa del usuario logueado
        $estado_usuario=$user->usuarios->get(0)->estado;// estado de el usuario logueado
        //dd($estado_empresa, $estado_usuario);
        //$carteras_por_atender=$carteras->where('tipo',1)->where('cargue','=','D')->get();////// filtro de las carteras tipo 1
       
        $current_day = Carbon::now()->dayOfWeek; // Produces something like "2019-03-11"
        if($current_day == 0){
            $current_day = 7;
        }
        $carteras_por_atender = DB::table('carteras')
                ->join('cartera_dia', 'cartera_dia.cartera_id', '=', 'carteras.id')
                ->where('empresa_id',$empresa_id)
                ->where('carteras.tipo',1)
                ->where('carteras.cargue','=','D')
                ->where('cartera_dia.dia_id','=',$current_day)
                ->select('carteras.*')
                ->get();

        $carteras_atendidas = DB::table('carteras')
                ->join('cartera_dia', 'cartera_dia.cartera_id', '=', 'carteras.id')
                ->where('empresa_id',$empresa_id)
                ->where('carteras.tipo',1)
                ->where('carteras.cargue','=','C')
                ->where('cartera_dia.dia_id','=',$current_day)
                ->select('carteras.*')
                ->get();

     

       
       
       
        //dd($carteras_por_atender);
       // $carteras_atendidas  =$carteras->where('tipo',1)->where('cargue','=','C')->get();
        //dd($carteras_atendidas,$carteras_por_atender);

        if($estado_empresa=='I'|| $estado_usuario=='I'){
            return view('errores.usuario');
        }
        else{return view('bodega.panel_central_bodega')
            ->with('carteras_atendidas',$carteras_atendidas)
            ->with('carteras_por_atender',$carteras_por_atender);}

                                                     
    }

    public function formulario_cargar_cartera($id)
    {
        //dd($id);
        $user = Auth::user();
        $empresa_id = $user->usuarios->get(0)->empresa_id;////// id de la empresa del usuario logueado
        $estado_usuario=$user->usuarios->get(0)->estado;// estado de el usuario logueado
        $estado_empresa=Empresa::find($empresa_id)->estado;// estado de la empresa del usuario logueado
        $productos=Producto::where('empresa_id',$empresa_id)->get();
        $empresa_id_cartera=Cartera::find($id)->empresa_id;
        $nombre_cartera=Cartera::find($id)->nombre;
        //dd($nombre_cartera);

        if($estado_empresa=='I' || $estado_usuario=='I'){
            return view('errores.usuario');
        }
        else{if($empresa_id == $empresa_id_cartera){

            return view('bodega.cargar.formulario_cartera_cargar')->with('productos',$productos)
                                                            ->with('cartera_id',$id)
                                                            ->with('nombre_cartera',$nombre_cartera);
            }
            else {
                return redirect('xxx');
            }
        }
                       
        
    }

    public function cargar_cartera(Request $request,$cartera_id)
    {   
        //dd($request); 
                
        $user = Auth::user();
        $empresa_id = $user->usuarios->get(0)->empresa_id;
        $productos=Producto::where('empresa_id',$empresa_id)->get();
        $clientes_cartera=Cliente::where('cartera_id',$cartera_id)->get()->all();
        //dd($clientes_cartera);

        try{
            DB::beginTransaction();
            //$contador=3;

            $user = Auth::user();
            $empresa_id = $user->usuarios->get(0)->empresa_id;
            $productos=Producto::where('empresa_id',$empresa_id)->get();
            
            $totalcargue=0;
                foreach($productos as $producto){
                    
                        $var_aux = 'cantidad_producto_'.$producto->id;
                        //dd($var_aux);
                        $productoid=$producto->id;
                        $producto_empresa = DB::select('select cantidad from productos where id = :id', ['id' => $producto->id]);//cantidad del producto en la bodega
                        //dd($producto_empresa);
                        //dd($request->input($var_aux));
                    
                    

                        if(is_null($request->input($var_aux)))  {
                            //dd('existe');
                            Nevera::create([
                                'cantidad'=>0,
                                'producto_id'=>$producto->id,
                                'cartera_id'=>$cartera_id
                                ]);
                                
                                
                        }else {
                                //dd('existe');
                                Nevera::create([
                                'cantidad'=>$request->input($var_aux),
                                'producto_id'=>$producto->id,
                                'cartera_id'=>$cartera_id
                                ]);
                                $totalcargue=$totalcargue+(($request->input($var_aux))*$producto->precio);
                            }
                        

                        $producto = DB::table('neveras')
                        ->select('id')
                        ->orderBy('created_at', 'desc')
                        ->first();

                    
                    
                        foreach($producto_empresa as $cantproducto){
                            $var_aux1 =$cantproducto;
                            //dd($var_aux1);
                            $cant=$var_aux1->cantidad;
                        }
                        
                        $cantproductoact=($cant-$request->input($var_aux));
                        //dd($productoid);

                        $affected = DB::update('update productos set cantidad = ? where id = ?', [$cantproductoact,$productoid]);
                        $affected = DB::update('update carteras set cargue = ? where id = ?', ['C',$cartera_id]);//actualizar el estado de la cartera a C (cargada)
                        
                        $total_deuda=0;
                        foreach($clientes_cartera as $cliente_cartera){
                            $var_aux1 =$cliente_cartera;
                            //dd($var_aux1);
                            $deuda=$var_aux1->deuda;
                            //dd($deuda);
                            $total_deuda=$total_deuda+$deuda;
                            
                        }
                        //dd($total_deuda);
                        $affected = DB::update('update carteras set credito_del_dia = ? where id = ?', [$total_deuda,$cartera_id]);//actualiza el total de la deuda de todos los clientes en la cartera
                        $affected = DB::update('update carteras set saldo_del_dia = ? where id = ?', [$total_deuda,$cartera_id]);//actualiza el total de la deuda de todos los clientes en la cartera

                        
                        
                        //$z=1/$contador;
                        //$contador=$contador-1;                  
                    }
            //dd($totalcargue);
            $affected = DB::update('update carteras set cargue_del_dia = ? where id = ?', [$totalcargue,$cartera_id]);//actualiza el cargue_del_dia de la cartera, cuando se carga la nevera, la cantidad de productos representada en plata
            
            DB::commit();
        }
        
            catch (\Exception $ex){dd($ex);
                                    DB::rollback();
                                    }
                                
     return redirect()->route('bodega');
            
    }

    public function informacion_carga_cartera($cartera_id)
    {
        $current_date= Carbon::now()->toDateString(); // Produces something like "2019-03-11 12:25:00"
        $user = Auth::user();
        $empresa_id = $user->usuarios->get(0)->empresa_id;////// id de la empresa del usuario logueado
        $estado_usuario=$user->usuarios->get(0)->estado;// estado de el usuario logueado
        $estado_empresa=Empresa::find($empresa_id)->estado;// estado de la empresa del usuario logueado
        $empresa_id_cartera=Cartera::find($cartera_id)->empresa_id;//////empresa a la cual pertenece la cartera
        $productos=Producto::where('empresa_id',$empresa_id)->get();
        $neveras=Nevera::where('cartera_id',$cartera_id)->get();
        $cargue_inicial=Cartera::find($cartera_id)->cargue_del_dia;
        $devoluciones= Devolucion::where('cartera_id',$cartera_id)->where('fecha',$current_date)->get();
        //dd($devoluciones);
        //dd($current_date);

        if($estado_empresa=='I' || $estado_usuario=='I'){
            return view('errores.usuario');
        }
            else{if($empresa_id == $empresa_id_cartera){

                return view('bodega.cargar.informacion_carga_cartera')->with('productos',$productos)
                                                                    ->with('neveras',$neveras)
                                                                    ->with('cargue_inicial',$cargue_inicial)
                                                                    ->with('cartera_id',$cartera_id)
                                                                    ->with('devoluciones',$devoluciones);
                }
                else {
                    return redirect('xxx');
                }
            }


                

    }

    public function formulario_recargar_cartera($nevera_id)
    {
        $user = Auth::user();
        $empresa_id = $user->usuarios->get(0)->empresa_id;////// id de la empresa del usuario logueado
        $estado_usuario=$user->usuarios->get(0)->estado;// estado de el usuario logueado
        $estado_empresa=Empresa::find($empresa_id)->estado;// estado de la empresa del usuario logueado

        $producto_nevera=Nevera::where('id',$nevera_id)->get();
        //dd($producto_nevera);

        if($estado_empresa=='I' || $estado_usuario=='I'){
            return view('errores.usuario');
        }
        else{return view('bodega.cargar.formulario_cartera_recargar')->with('producto_nevera',$producto_nevera)
            ->with('nevera_id',$nevera_id);}
        
    }

    public function recargar_cartera(Request $request,$nevera_id)
    {
        $cartera_id=Nevera::Find($nevera_id)->cartera_id; 
        $precio_producto=Nevera::Find($nevera_id)->producto->precio;
        //dd($precio_producto);
        $cargue_inicial=Cartera::Find($cartera_id)->cargue_del_dia;
        //dd($cargue_inicial);

        $validatedData = $request->validate([
            'cantidad' => 'required'
            ]);
        //dd($request->cantidad, $nevera_id);

        $producto_nevera=Nevera::Find($nevera_id);//cartera a la cual pertenece el producto que esta en la nevera
        //dd($producto_nevera->producto_id);

                                    try{
                                        DB::beginTransaction();
                                        //$contador=3;
                                                       
                                        $totalcargue=$cargue_inicial+(($request->cantidad)*($precio_producto));
                                        //dd($totalcargue);
                                        $affected = DB::update('update carteras set cargue_del_dia = ? where id = ?', [$totalcargue,$cartera_id]);




                                        $cantproductoact=(($producto_nevera->producto->cantidad)-($request->cantidad));
                                        
                                        $affected = DB::update('update productos set cantidad = ? where id = ?', [$cantproductoact,$producto_nevera->producto_id]);
                                        $affected = DB::update('update neveras set cantidad = ? where id = ?', [($producto_nevera->cantidad)+($request->cantidad),$nevera_id]);
                                        // $z=1/$contador;
                                        // $contador=$contador-1;

                                        DB::commit();
                                    }
                                    catch (\Exception $ex){dd($ex);
                                                            DB::rollback();
                                                            }

    return redirect()->route('bodega.informacion_carga_cartera',$cartera_id);
                                                        

    }

    public function formulario_descargar_cartera($nevera_id)
    {
        //dd('hola');
        $user = Auth::user();
        $empresa_id = $user->usuarios->get(0)->empresa_id;////// id de la empresa del usuario logueado
        $estado_usuario=$user->usuarios->get(0)->estado;// estado de el usuario logueado
        $estado_empresa=Empresa::find($empresa_id)->estado;// estado de la empresa del usuario logueado
        $producto_nevera=Nevera::where('id',$nevera_id)->get();
        //dd($producto_nevera);

        if($estado_empresa=='I' || $estado_usuario=='I'){
            return view('errores.usuario');
        }
        else{return view('bodega.cargar.formulario_cartera_descargar')->with('producto_nevera',$producto_nevera)
            ->with('nevera_id',$nevera_id);}
        
    }

    public function descargar_cartera(Request $request,$nevera_id)
    {
        $cartera_id=Nevera::Find($nevera_id)->cartera_id; 
        $precio_producto=Nevera::Find($nevera_id)->producto->precio;
        //dd($precio_producto);
        $cargue_inicial=Cartera::Find($cartera_id)->cargue_del_dia;
        //dd($cargue_inicial);

        //dd('descargar');
        $validatedData = $request->validate([
            'cantidad' => 'required'
            ]);
        //dd($request->cantidad, $nevera_id);

        $producto_nevera=Nevera::Find($nevera_id);
        //dd($producto_nevera->producto_id);

            try{
                DB::beginTransaction();
                //$contador=3;
                
                $totalcargue=$cargue_inicial-(($request->cantidad)*($precio_producto));
                //dd($totalcargue);
                $affected = DB::update('update carteras set cargue_del_dia = ? where id = ?', [$totalcargue,$cartera_id]);



                
                $cantproductoact=(($producto_nevera->producto->cantidad)+($request->cantidad));

                $affected = DB::update('update productos set cantidad = ? where id = ?', [$cantproductoact,$producto_nevera->producto_id]);
                $affected = DB::update('update neveras set cantidad = ? where id = ?', [($producto_nevera->cantidad)-($request->cantidad),$nevera_id]);
                // $z=1/$contador;
                // $contador=$contador-1;
                DB::commit();
            }
            catch (\Exception $ex){dd($ex);
                                    DB::rollback();
                                    }

                return redirect()->route('bodega.informacion_carga_cartera',$cartera_id);
                                                        
 
    }
    

    
    public function cierre_dia_cartera($cartera_id)
    {
        //dd($cartera_id);
        $cartera=Cartera::Find($cartera_id);//datos de la cartera
        //dd($cartera->credito_del_dia);
        $current_date = Carbon::now()->toDateString();
        
        try{
            DB::beginTransaction();
            //$contador=3;

            $productos_nevera=Nevera::where('cartera_id',$cartera_id)->get();
            //dd($productos_nevera);

            foreach($productos_nevera as $producto){
                $var_aux1 =$producto;
                //dd($var_aux1);
                $produnev_id=$var_aux1->producto_id;
                $produnev_cant=$var_aux1->cantidad;
                $produbod_cant=$var_aux1->producto->cantidad;
                //dd($produnev_id, $produnev_cant, $produbod_cant);
                //dd();
                



                $cantproductoact=(($produnev_cant)+($produbod_cant));
                $affected = DB::update('update productos set cantidad = ? where id = ?', [$cantproductoact,$produnev_id]);
                        //$affected = DB::update('update neveras set cantidad = ? where id = ?', [($producto_nevera->cantidad)-($request->cantidad),$nevera_id]);

                
            }

            $productos_nevera=Nevera::where('cartera_id',$cartera_id)->get()->all();
            $descargue=0;
            foreach($productos_nevera as $producto){
                $var_aux1 =$producto;
                //dd($var_aux1);
                $produnev_id=$var_aux1->producto_id;
                $produnev_cant=$var_aux1->cantidad;
                $produnev_precio=$var_aux1->producto->precio;
                //dd($produnev_id, $produnev_cant, $produnev_precio);
                //dd();
                $descargue=$descargue+(($produnev_cant)*($produnev_precio));
                
            }
            
            //dd($cartera_id);
            //dd($total);
            
            
            $cargue_inicial=Cartera::find($cartera_id)->cargue_del_dia;
            $abonos=Cartera::find($cartera_id)->abono_del_dia;
            
            if(is_null($bonos=Bono::where('cartera_id',$cartera_id)->where('tipo',1)->where('mi_fecha',$current_date)->first())){
                
                $bonos = 0;
                
            }else{$bonos=Bono::where('cartera_id',$cartera_id)->where('tipo',1)->where('mi_fecha',$current_date)->first()->valor;}
            
            if(is_null($almuerzos=Bono::where('cartera_id',$cartera_id)->where('tipo',2)->where('mi_fecha',$current_date)->first())){
                
                $almuerzos = 0;
                
            }else{$almuerzos=Bono::where('cartera_id',$cartera_id)->where('tipo',2)->where('mi_fecha',$current_date)->first()->valor;}

            if(is_null($gastos=Bono::where('cartera_id',$cartera_id)->where('tipo',3)->where('mi_fecha',$current_date)->first())){
                
                $gastos = 0;
                
            }else{$gastos=Bono::where('cartera_id',$cartera_id)->where('tipo',3)->where('mi_fecha',$current_date)->first()->valor;}     
            
            $total=$abonos-($gastos+$almuerzos+$bonos);
            DB::insert('insert into cuentas (fecha, cartera_id, cargue, abono, bono, almuerzo, gasto, descargue, total) values (?, ?, ?, ?, ?, ?, ?, ?, ?)', [$current_date, $cartera_id, $cargue_inicial, $abonos, $bonos, $almuerzos, $gastos, $descargue, $total]);
            
            
            //dd($productos_nevera);
            //dd($cuentas);

           







            $affected = DB::update('update carteras set credito_del_dia = ? where id = ?', ['0',$cartera_id]);//actualiza el total de la deuda  en la cartera
            $affected = DB::update('update carteras set saldo_del_dia = ? where id = ?', ['0',$cartera_id]);//actualiza el total del saldo  en la cartera
            $affected = DB::update('update carteras set abono_del_dia = ? where id = ?', ['0',$cartera_id]);//actualiza el total de la abono  en la cartera
            $affected = DB::update('update carteras set venta_del_dia = ? where id = ?', ['0',$cartera_id]);//actualiza el total de la venta  en la cartera
            $affected = DB::update('update carteras set cargue_del_dia = ? where id = ?', ['0',$cartera_id]);//actualiza el cargue_del_dia de la cartera, cuando se descarga la nevera, la cantidad de productos representada en plata
            DB::table('neveras')->where('cartera_id', '=', $cartera_id)->delete();
            $affected = DB::update('update carteras set cargue = ? where id = ?', ['D',$cartera_id]);//actualizar el estado de la cartera a D (descargada)
           
            //dd($cartera->salida_del_dia);
            $credito=$cartera->credito_del_dia;
            //dd($credito);
            $saldo=$cartera->saldo_del_dia;
            //dd($saldo);
            $abono=$cartera->abono_del_dia;
            //dd($abono);
            $venta=$cartera->venta_del_dia;
            //dd($venta);
            $saldo_final=($credito+$venta)-($abono);
            //dd($saldo_final);
            DB::insert('insert into historial_venta_carteras (cartera_id, fecha, venta, deuda, saldo, abono, saldo_final) values (?, ?, ?, ?, ?, ?, ?)', [$cartera_id, $current_date, $venta, $credito, $saldo, $abono, $saldo_final]);
           
           
            DB::commit();
           
            



        }
        catch (\Exception $ex){dd($ex);
                                DB::rollback();
                                }

            return redirect()->route('bodega');
    }

    
    // public function destroy($id)
    // {
    //     //
    // }
}
