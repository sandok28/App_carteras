<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empresa;
use App\Cartera;
use App\Usuario;
use App\User;
use App\Rules\UsuariosEmailRule;
use App\Rules\UsuariosTipo3Rule;
use Illuminate\Support\Facades\DB;
use Auth;


class AdministradorController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('RolUserAdminMiddleware');
      
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function administrador_empresas()
    {

        $empresas_todas = Empresa::all();

        return view('administradores.administrador_empresas')->with('empresas_todas', $empresas_todas); 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function administrador_usuarios()
    {
        $usuarios_administradores = Usuario::where('tipo',1)->get(); // 1 - usuario tipo administrador
    
        return view('administradores.administrador_usuarios')->with('usuarios_administradores', $usuarios_administradores); 
    }

    public function formulario_usuarios_crear()
    {

        
        return view('administradores.administrador_usuarios.formulario_usuarios_crear');
    }


    public function usuarios_crear(Request $request)
    {
       
        $validatedData = $request->validate([
                                            'nombre' => 'required',
                                            'cedula' => 'required',
                                            'telefono' => 'required',
                                            'direccion' => 'required',
                                            'email' => new UsuariosEmailRule            
                                            ]);
        $usuario = new Usuario();
        $usuario->nombre = $request->input('nombre');
        $usuario->cedula = $request->input('cedula');
        $usuario->nit = '0'; //Usuario administrador no requiere nit
        $usuario->telefono = $request->input('telefono');
        $usuario->direccion = $request->input('direccion');
        $usuario->tipo = '1'; // 1 - Administrador
        $usuario->estado = 'A'; // A - Activo

        
        //Vincular correo a un user registrado en el sistema
        $user = User::Where('email',$request->input('email'))->get()->get(0);
       
        $usuario->user_id = $user->id;

        $usuario->empresa_id = $request->input('empresa_id');
        $usuario->save();

        return redirect()->route('administrador.administrador_usuarios');
    }

    
    public function formulario_usuarios_actualizar($usuario_id)
    {
        //dd($usuario);
        $usuario = Usuario::find($usuario_id);
       
        //dd($usuario->user->email);
        return view('administradores.administrador_usuarios.formulario_usuarios_actualizar', compact('usuario'));
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
        $validatedData = $request->validate([
                                            'nombre' => 'required',
                                            'cedula' => 'required',
                                            'telefono' => 'required',
                                            'direccion' => 'required',
                                            'email' => new UsuariosEmailRule          
                                            ]);

        $usuario = Usuario::find($usuario_id);

        $usuario->fill($request->all());
        
        
        //Vincular correo a uno user registrado en el sistema
        $user = User::Where('email',$request->input('email'))->get()->get(0);
       
        $usuario->user_id = $user->id;

        $usuario->save();

        return redirect()->route('administrador.administrador_usuarios');
    
    }


    public function usuarios_desactivar($usuario_id)
    {

        $usuario = Usuario::find($usuario_id);
      
        $usuario->estado = "I";
        $usuario->save(); 

        return redirect()->route('administrador.administrador_usuarios');
    }

   
    public function usuarios_activar(Usuario $usuario)
    {


        $usuario->estado = "A";
        $usuario->save();

        return redirect()->route('administrador.administrador_usuarios');
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function administrador_carteras($empresa_id)
    {
        $empresa_carteras = Cartera::where('empresa_id',$empresa_id)->get();

        return view('administradores.administrador_carteras')->with('empresa_carteras', $empresa_carteras)
                                                             ->with('empresa_id', $empresa_id); 
    }

    public function formulario_carteras_crear($empresa_id)
    {


        $usuarios_empresa = DB::table('usuarios')
                            ->whereNotIn('id', DB::table('carteras')->pluck('usuario_id'))
                            ->where([
                                ['usuarios.empresa_id','=',$empresa_id],
                                ['usuarios.estado','=','A'],//Activo
                                ['usuarios.tipo','=','3']// 3 - Carterista
                            ])
                            ->pluck(
                                'nombre',
                                'id'                                
                           );
    
        return view('administradores.administrador_carteras.formulario_carteras_crear')->with('empresa_id', $empresa_id)
                                                                                       ->with('usuarios_empresa', $usuarios_empresa);
    }


    public function carteras_crear(Request $request)
    {
   
        $validatedData = $request->validate([
                                            'nombre' => 'required',
                                            'descripcion' => 'required',
                                            'usuario_id' => new UsuariosTipo3Rule
            
                                            ]);
        $cartera = new Cartera();
        $cartera->nombre = $request->input('nombre');
        $cartera->descripcion = $request->input('descripcion');
        $cartera->estado = 'A'; // A - Activo
        $cartera->empresa_id = $request->input('empresa_id');
        $cartera->usuario_id ='0';
        //$cartera->usuario_id = $request->input('usuario_id');
    
        
        
        $cartera->save();

        return redirect()->route('administrador.administrador_carteras',$request->input('empresa_id')); 
    }

    
    public function formulario_carteras_actualizar($empresa_id,$cartera_id)
    {


        $usuario_actual_cartera = DB::table('usuarios')
                  ->join('carteras', 'carteras.usuario_id','=','usuarios.id')
                  ->where('carteras.id','=',$cartera_id)
                  ->select('usuarios.nombre as nombre', 'usuarios.id as id');

        $usuarios_empresa = DB::table('usuarios')
                            ->whereNotIn('id', DB::table('carteras')->pluck('usuario_id'))
                            ->where([
                                ['usuarios.empresa_id','=',$empresa_id],
                                ['usuarios.estado','=','A'],//Activo
                                ['usuarios.tipo','=','3']// 3 - Carterista
                            ])
                            ->select('usuarios.nombre as nombre ', 'usuarios.id as id')
                            ->union($usuario_actual_cartera)->get();
         
       

       $usuarios_empresa = $usuarios_empresa->all();

        dd($usuarios_empresa,$usuario_actual_cartera); 
        $cartera = Cartera::find($cartera_id);
        return view('administradores.administrador_carteras.formulario_carteras_actualizar' )->with('cartera',$cartera)
                                                                                            ->with('empresa_id',$empresa_id)
                                                                                            ->with('usuarios_empresa',$usuarios_empresa);
    }

    public function carteras_actualizar(Request $request,$cartera_id)
    {

        //dd('hola');
        $validatedData = $request->validate([
                                        'nombre' => 'required',
                                        'descripcion' => 'required',
                                        'usuario_id' => new UsuariosTipo3Rule
                                        ]);

        $cartera = Cartera::find($cartera_id);

        $cartera->fill($request->all());

        $cartera->save();

        return redirect()->route('administrador.administrador_carteras',$request->input('empresa_id')); 
    
    }


    public function carteras_desactivar($cartera_id)
    {
        
        $cartera = Cartera::find($cartera_id);
        //dd($cartera);
        $empresa_id=$cartera->empresa_id;
        $cartera->estado = "I";
        $cartera->save(); 

        return redirect()->route('administrador.administrador_carteras',$empresa_id);
    }

   
    public function carteras_activar($cartera_id)
    {

        
        $cartera = Cartera::find($cartera_id);
        //dd($cartera);
        $cartera->estado = "A";
        $cartera->save();

        return redirect()->route('administrador.administrador_carteras',1);
    }





 
}
