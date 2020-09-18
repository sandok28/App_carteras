<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empresa;
use App\Cartera;
use App\Usuario;
use Auth;


class AdministradorController extends Controller
{




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function panel_central_administrador()
    {

        $empresas_todas = Empresa::all();

        $usuarios_administradores = Usuario::where('tipo',1)->get(); // 1 - usuario tipo administrador


        return view('administradores.panel_central_administrador')->with('empresas_todas', $empresas_todas)
                                               ->with('usuarios_administradores', $usuarios_administradores); 
    }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function empresas()
    {
        $empresas = Empresa::all(); 

        //dd($empresas);
       

        return view('administradores.empresas')->with('empresas', $empresas); 
    }




    public function administradorEmpresaCartera($empresa_id)
    {

        //dd($empresa_id);

        $admin_carteras = Cartera::where('empresa_id',$empresa_id)->get();
        
        //dd($admin_carteras);

        return view('administradores.empresas_carteras')->with('admin_carteras', $admin_carteras)
                                                        ->with('id_empresa', $empresa_id); 
    }

    public function administradorEmpresaCarteraedit($empresa_id)
    {
        
        return view('administradores.empresas_carteras_edit')->with('id_empresa', $empresa_id);
                                                         
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
