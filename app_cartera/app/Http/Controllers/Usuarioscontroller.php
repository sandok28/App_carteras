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
    public function inicio()
    {
        $usuarios = Usuario::all();
        return view('usuarios.index', compact('usuarios')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function formulario_usuarios_crear()
    {
        return view('usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function usuarios_crear(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required',
            'cedula' => 'required' 
            
            ]);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function formulario_usuarios_actualizar($usuario_id)
    {
       // dd($usuario);
        $usuario = Usuario::find($usuario_id);
        //dd($usuario);
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
    
    public function usuarios_actualizar(Request $request,$usuario_id)
    {

        $usuario = Usuario::find($usuario_id);
        //dd($usuario);
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
///////////////Vista Administrador///////////////


    public function formulario_usuariosadmin_crear()
        {
            //dd("hola");
            return view('usuarios.create');
        }

    
        public function usuariosadmin_crear(Request $request)
        {
            $validatedData = $request->validate([
                'nombre' => 'required',
                'cedula' => 'required' 
                
                ]);
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

            return redirect('/administrador');
        }

        
        public function formulario_usuariosadmin_actualizar($usuario_id)
        {
        // dd($usuario);
            $usuario = Usuario::find($usuario_id);
            //dd($usuario);
            //dd($usuario->user->email);
            return view('usuarios.edit', compact('usuario'));
        }

        
        
        public function usuariosadmin_actualizar(Request $request,$usuario_id)
        {

            $usuario = Usuario::find($usuario_id);
            //dd($usuario);
            $usuario->fill($request->all());
            $user = User::Where('email',$request->input('email'))->take(1)->get();
            //dd($user,$request->input('email'));

            if(is_null($user->get(0))){
                dd("El correo no existe");
            }

            $usuario->user_id = $user->get(0)->id; 

            $usuario->save();

            return redirect('/administrador');
        
        }


    public function activarUsuarioAdministrador(Usuario $usuario)
    {

        
        $usuario->estado = "A";
        $usuario->save();

        return redirect('/administrador');
    }

    public function desActivarUsuarioAdministrador($usuario_id)
    {
        
        $usuario = Usuario::find($usuario_id);
        $usuario->estado = "I";
        $usuario->save(); 

        return redirect('/administrador');
    }
}
