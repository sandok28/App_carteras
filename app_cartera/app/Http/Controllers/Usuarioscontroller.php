<?php

namespace App\Http\Controllers;

use App\Usuario;
use App\User;
use Illuminate\Http\Request;

class Usuarioscontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = Usuario::all();
        
        return view('usuarios.index', compact('usuarios')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usuario = new Usuario();
        $usuario->nombre = $request->input('nombre');
        $usuario->cedula = $request->input('cedula');
        $usuario->nit = $request->input('nit');
        $usuario->telefono = $request->input('telefono');
        $usuario->direccion = $request->input('direccion');
        $usuario->tipo = '3'; // 3 - Carterista
        $usuario->estado = 'A'; // A - Activo

        $user = User::Where('email',$request->input('email'))->take(1)->get();
        $usuario->user_id = $user->get(0)->id;

        $usuario->empresa_id = $request->input('empresa_id');
        $usuario->save();

        return redirect('/usuarios');
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
    public function edit(Usuario $usuario)
    {

        //dd($usuario->user->email);
        return view('usuarios.edit', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function update(Request $request, Usuario $usuario)
    {


        $usuario->fill($request->all());
        $user = User::Where('email',$request->input('email'))->take(1)->get();
        //dd($user,$request->input('email'));

        if(is_null($user->get(0))){
            dd("El correo no existe");
        }

        $usuario->user_id = $user->get(0)->id; 

        $usuario->save();

        return redirect('/usuarios');
    
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function desActivarUsuario($usuario_id)
    {

        //dd($usuario_id);
        $usuario = Usuario::find($usuario_id);
       // dd($usuario);
        $usuario->estado = "I";
        $usuario->save(); 

        return redirect('/usuarios');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function activarUsuario(Usuario $usuario)
    {


        $usuario->estado = "A";
        $usuario->save();

        return redirect('/usuarios');
    }
}
