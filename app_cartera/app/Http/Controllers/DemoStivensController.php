<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Devolucion;
use App\Empresa;
use App\Producto;
use Auth;
use Illuminate\Http\Request;

class DemoStivensController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function inicio()
    {
        $devoluciones = Devolucion::all();
        return view('stivens.devoluciones.index', compact('devoluciones'));
    }

    public function inicio_cliente()
    {
        $clientes = Cliente::all();
        return view('stivens.clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function formulario_devoluciones_crear()
    {
            $user = Auth::user();
            //dd($user);
            $productos = $user->usuarios->get(0)->empresa->productos;
            $cantidad_productos = $productos->count();
           // dd($productos,$cantidad_productos);
            return view('stivens.devoluciones.create')->with('productos', $productos)
                                                      ->with('cantidad_productos', $cantidad_productos);
            

    }

    public function formulario_clientes_crear()
    {
            return view('stivens.clientes.create');
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function devoluciones_crear(Request $request)
    {
        //

        //dd($request);
        
        //dd($devolucion);
        $cantidad_productos= $request->input('cantidad');
        
        for($i=0;$i<$cantidad_productos;$i++)
            {
            $devolucion = new Devolucion();
            $devolucion->producto_cantidad = $request->input('producto_'.$i.'_cantidad');
            
            $devolucion->fecha= "0001-01-01";
            $devolucion->producto_id=$request->input('producto_id_'.$i);
            //dd($devolucion);
            $devolucion->save();
            }
            

            return redirect('/devoluciones');
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
}
