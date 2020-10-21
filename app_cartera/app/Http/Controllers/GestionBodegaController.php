<?php

namespace App\Http\Controllers;

use Auth;
use App\Cartera;
use App\Producto;
use App\Nevera;
use App\Cliente;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class GestionBodegaController extends Controller
{
    
    public function panel_central_bodega()
    {

        $user = Auth::user();
        $empresa_id = $user->usuarios->get(0)->empresa_id;////// id de la empresa del usuario logueado
        $cartera = Cartera::where('empresa_id',$empresa_id);////// carteras de la empresa del usuario logueado
        $carteras_por_atender=$cartera->where('tipo',1)->where('cargue','=','D')->get();////// filtro de las carteras tipo 1
        //dd($carteras_por_atender);
        $cartera = Cartera::where('empresa_id',$empresa_id);
        $carteras_atendidas  =$cartera->where('tipo',1)->where('cargue','=','C')->get();
        //dd($carteras_atendidas,$carteras_por_atender);


        return view('bodega.panel_central_bodega')
                                                  ->with('carteras_atendidas',$carteras_atendidas)
                                                  ->with('carteras_por_atender',$carteras_por_atender);
                                                     
    }

    public function formulario_cargar_cartera($id)
    {
        //dd($id);
        $user = Auth::user();
        $empresa_id = $user->usuarios->get(0)->empresa_id;
        $productos=Producto::where('empresa_id',$empresa_id)->get();
        $empresa_id_cartera=Cartera::find($id)->empresa_id;
        $nombre_cartera=Cartera::find($id)->nombre;
        //dd($nombre_cartera);


        if($empresa_id == $empresa_id_cartera){

            return view('bodega.cargar.formulario_cartera_cargar')->with('productos',$productos)
                                                              ->with('cartera_id',$id)
                                                              ->with('nombre_cartera',$nombre_cartera);
        }
        else {
            return redirect('xxx');
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
            

                foreach($productos as $producto){

                    $var_aux = 'cantidad_producto_'.$producto->id;
                    //dd($var_aux);
                    $productoid=$producto->id;
                    $producto_empresa = DB::select('select cantidad from productos where id = :id', ['id' => $producto->id]);//cantidad del producto en la bodega
                    //dd($producto_empresa);
                    //dd($request->input($var_aux));

                    

                        if(is_null($request->input($var_aux))) {
                            //dd('no existe');
                            Nevera::create([
                                'cantidad'=>0,
                                'producto_id'=>$producto->id,
                                'cartera_id'=>$cartera_id
                                ]);
                        } else {
                            //dd('existe');
                            Nevera::create([
                                'cantidad'=>$request->input($var_aux),
                                'producto_id'=>$producto->id,
                                'cartera_id'=>$cartera_id
                                ]);
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

                        
                        
                        //$z=1/$contador;
                        //$contador=$contador-1;                  
            }
            
            DB::commit();
        }
        catch (\Exception $ex){dd($ex);
                                DB::rollback();
                                }

            return redirect()->route('bodega');
            
    }

    public function informacion_carga_cartera($cartera_id)
    {

        $user = Auth::user();
        $empresa_id = $user->usuarios->get(0)->empresa_id;
        $empresa_id_cartera=Cartera::find($cartera_id)->empresa_id;//////empresa a la cual pertenece la cartera
        $productos=Producto::where('empresa_id',$empresa_id)->get();
        $neveras=Nevera::where('cartera_id',$cartera_id)->get();
        

        if($empresa_id == $empresa_id_cartera){

            return view('bodega.cargar.informacion_carga_cartera')->with('productos',$productos)
                                                                  ->with('neveras',$neveras)
                                                                  ->with('cartera_id',$cartera_id);
        }
        else {
            return redirect('xxx');
        }

    }

    public function formulario_recargar_cartera($nevera_id)
    {
        $producto_nevera=Nevera::where('id',$nevera_id)->get();
        //dd($producto_nevera);
        return view('bodega.cargar.formulario_cartera_recargar')->with('producto_nevera',$producto_nevera)
                                                                ->with('nevera_id',$nevera_id);
    }

    public function recargar_cartera(Request $request,$nevera_id)
    {

        $validatedData = $request->validate([
            'cantidad' => 'required'
            ]);
        //dd($request->cantidad, $nevera_id);

        $producto_nevera=Nevera::Find($nevera_id);//cartera a la cual pertenece el producto que esta en la nevera
        //dd($producto_nevera->producto_id);

                                    try{
                                        DB::beginTransaction();
                                        //$contador=3;
                                                          
                                        
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

                                        return redirect()->route('bodega');
                                                        

    }

    public function formulario_descargar_cartera($nevera_id)
    {
        //dd('hola');
        $producto_nevera=Nevera::where('id',$nevera_id)->get();
        //dd($producto_nevera);
        return view('bodega.cargar.formulario_cartera_descargar')->with('producto_nevera',$producto_nevera)
                                                                ->with('nevera_id',$nevera_id);
    }

    public function descargar_cartera(Request $request,$nevera_id)
    {
        //dd('descargar');
        $validatedData = $request->validate([
            'cantidad' => 'required'
            ]);
        //dd($request->cantidad, $nevera_id);

        $producto_nevera=Nevera::Find($nevera_id);//cartera a la cual pertenece el producto que esta en la nevera
        //dd($producto_nevera->producto_id);

            try{
                DB::beginTransaction();
                //$contador=3;
                                    
                
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

                return redirect()->route('bodega');
                                                        
 
    }
    

    
    public function cierre_dia_cartera($cartera_id)
    {
        //dd($cartera_id);
        $cartera=Cartera::Find($cartera_id);//datos de la cartera
        //dd($cartera->salida_del_dia);
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
            $affected = DB::update('update carteras set credito_del_dia = ? where id = ?', ['0',$cartera_id]);//actualiza el total de la deuda de todos los clientes en la cartera
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
            DB::insert('insert into historial_venta_carteras (cartera_id, fecha, venta, deuda, saldo, abono) values (?, ?, ?, ?, ?, ?)', [$cartera_id, $current_date, $venta, $credito, $saldo, $abono]);
           
           
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
