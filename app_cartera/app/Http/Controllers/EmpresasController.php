<?php

namespace App\Http\Controllers;

use App\Empresa;
use App\Producto;
use Auth;
use Illuminate\Http\Request;

class EmpresasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('RolUserAdminMiddleware');
    }

    public function formulario_empresas_crear()
    {
        return view('administradores.administrador_empresas.formulario_empresas_crear');
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

        return redirect()->route('administrador.administrador_empresas');
    }

    public function formulario_empresas_actualizar($empresa_id)
    {
        
       
        $empresa = Empresa::find($empresa_id);
        return view('administradores.administrador_empresas.formulario_empresas_actualizar', compact('empresa'));
    }

    public function empresas_actualizar(Request $request, $empresa_id)
    {
        $validatedData = $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'telefono' => 'required'
            ]);

        $empresa = Empresa::find($empresa_id);
        $empresa->fill($request->all());
        $empresa->telefono = $request->input('telefono');
        $empresa->save();
        return redirect()->route('administrador.administrador_empresas');
    }

    public function vistacarterasempresa($empresa_id)//vista de las carteras de la empresa del usuario logueado
    {
       
         $user = Auth::user();
         $empresa_cartera = $user->usuarios->get(0)->empresa->carteras;
         return view('administradoresempresas.empresas_carteras')->with('empresa_carteras', $empresa_cartera);
         
    }

    public function vistaproductosempresa()
    {
         $user = Auth::user();
         $producto_empresa = $user->usuarios->get(0)->empresa->productos;
        
         return view('administradores.productos_empresas')->with('producto_empresa', $producto_empresa);
        
    }

    
    public function empresas_desactivar(Empresa $empresa)
    {
        $empresa->estado = "I"; //I - Inactivo
        $empresa->save();

        return redirect()->route('administrador.administrador_empresas');
    }

    
    public function empresas_activar(Empresa $empresa)
    {
        $empresa->estado = "A"; // A - Activo
        $empresa->save();

        return redirect()->route('administrador.administrador_empresas');
    }
}



