<?php

namespace App\Http\Controllers;

use App\Producto;
use Auth;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function inicio()
    {
        //
        $productos = Producto::all();
        return view('productos.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function formulario_productos_crear()
    {
        return view('productos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function productos_crear(Request $request)
    {
        //
        $validatedData = $request->validate([
        'nombre' => 'required',
        'precio' => 'required',
        'cantidad' => 'required',
        'descripcion' => 'required'
        
        ]);
        $user = Auth::user();
        $producto = new Producto();
        $producto->nombre = $request->input('nombre');
        $producto->precio = $request->input('precio');
        $producto->cantidad = $request->input('cantidad');
        $producto->empresa_id = $user->usuarios->get(0)->empresa_id;
        $producto->descripcion = $request->input('descripcion');
        $producto->estado ='A';

        $producto->save();

        return redirect('/productos');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function formulario_productos_actualizar($producto_id)
    {
        //dd($producto_id);
        $producto = Producto::find($producto_id);
        return view('productos.edit', compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function productos_actualizar(Request $request, $producto_id)
    {
        $producto = Producto::find($producto_id);
        $producto->fill($request->all());
        $producto->save();
        return redirect('/productos');
    }

    public function desActivarProducto(Producto $producto)
    {
        $producto->estado = "I";
        $producto->save();

        return redirect('/productos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cartera  $cartera
     * @return \Illuminate\Http\Response
     */
    public function activarProducto(Producto $producto)
    {
        $producto->estado = "A";
        $producto->save();

        return redirect('/productos');
    }
}

