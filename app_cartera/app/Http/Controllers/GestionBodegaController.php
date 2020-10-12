<?php

namespace App\Http\Controllers;

use Auth;
use App\Cartera;
use App\Producto;
use App\Nevera;
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
        $user = Auth::user();
        $empresa_id = $user->usuarios->get(0)->empresa_id;
        $productos=Producto::where('empresa_id',$empresa_id)->get();

        try{
            DB::beginTransaction();
            //$contador=3;

            $user = Auth::user();
            $empresa_id = $user->usuarios->get(0)->empresa_id;
            $productos=Producto::where('empresa_id',$empresa_id)->get();

                foreach($productos as $producto){

                    $var_aux = 'cantidad_producto_'.$producto->id;
                    $productoid=$producto->id;
                    $producto_empresa = DB::select('select cantidad from productos where id = :id', ['id' => $producto->id]);//cantidad del producto en la bodega
                    //dd($producto_empresa);

                    Nevera::create([
                        'cantidad'=>$request->input($var_aux),
                        'producto_id'=>$producto->id,
                        'cartera_id'=>$cartera_id
                
                    ]);

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
                        $affected = DB::update('update carteras set cargue = ? where id = ?', ['C',$cartera_id]);
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

    public function formulario_recargar_cartera($cartera_id)
    {
        
    }

    public function recargar_cartera($cartera_id)
    {
        
    }

    public function formulario_descargar_cartera($cartera_id)
    {
        
    }

    public function descargar_cartera($cartera_id)
    {
        
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
