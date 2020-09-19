<?php

namespace App\Http\Controllers;

use App\Empresa;
use App\Producto;
use Auth;
use Illuminate\Http\Request;

class EmpresasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */

    public function inicio()
    {
        //$user = Auth::user();
        //$empresa_cartera = $user->usuarios->get(0)->empresa->carteras;
        $empresas = Empresa::all();
        return view('Empresas.index', compact('empresas'));
        
    }

    public function formulario_empresas_crear()
    {
        return view('empresas.create');
    }

    public function empresas_crear(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'telefono' => 'required'
            
            ]);
        
        $empresa = new Empresa();
        $empresa->nombre = $request->input('nombre');
        $empresa->descripcion = $request->input('descripcion');
        $empresa->telefono = $request->input('telefono');
        $empresa->save();

        return redirect('/administrador');
    }

    public function formulario_empresas_actualizar($empresa_id)
    {
        //dd($producto_id);
        $empresa = Empresa::find($empresa_id);
        return view('empresas.edit', compact('empresa'));
    }

    public function empresas_actualizar(Request $request, $empresa_id)
    {
        $empresa = Empresa::find($empresa_id);
        $empresa->fill($request->all());
        $empresa->telefono = $request->input('telefono');
        $empresa->save();
        return redirect('/administrador');
    }

    public function vistacarterasempresa($empresa_id)//vista de las carteras de la empresa del usuario logueado
    {
        //
         $user = Auth::user();
         $empresa_cartera = $user->usuarios->get(0)->empresa->carteras;
         return view('administradoresempresas.empresas_carteras')->with('empresa_carteras', $empresa_cartera);
         //dd($empresa_cartera );
    }
    public function vistaproductosempresa()
    {
        //
         $user = Auth::user();
         //dd($user->usuarios->get(0)->empresa->hola());
         $producto_empresa = $user->usuarios->get(0)->empresa->productos;
         
         //dd($producto_empresa);


        // $producto_empresa = Producto::where('empresa_id','2')->get();
         return view('administradores.productos_empresas')->with('producto_empresa', $producto_empresa);
         //dd($producto_empresa);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'telefono' => 'required'
            
            ]);
        
        $empresa = new Empresa();
        $empresa->nombre = $request->input('nombre');
        $empresa->descripcion = $request->input('descripcion');
        $empresa->telefono = $request->input('telefono');
        $empresa->save();

        return redirect('/administrador');
    }

   


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function edit(Empresa $empresa)
    {
        
        return view('empresas.edit', compact('empresa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empresa $empresa)
    {
        //dd($empresa,$request);
        $empresa->fill($request->all());
        $empresa->telefono = $request->input('telefono');
        $empresa->save();

        return redirect('/administrador');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function desActivarEmpresa(Empresa $empresa)
    {
        $empresa->estado = "I";
        $empresa->save();

        return redirect('/administrador');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function activarEmpresa(Empresa $empresa)
    {
        $empresa->estado = "A";
        $empresa->save();

        return redirect('/administrador');
    }
}

////////

