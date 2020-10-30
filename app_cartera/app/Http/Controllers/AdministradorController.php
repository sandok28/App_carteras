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
use Illuminate\Support\Facades\Hash;
use Auth;
use Carbon\Carbon;
//STIVENS

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
                                            'contrasena' => 'required',
                                            'email' => 'required',                                            
                                            'email' => new UsuariosEmailRule            
                                            ]);

        //usar transaccion
        try{DB::beginTransaction();
            $current_date_time = Carbon::now()->toDateTimeString(); // Produces something like "2019-03-11 12:25:00"


            User::create([
                
                'name' => $request->input('nombre'),
                'email' =>$request->input('email'),
                'password'=> Hash::make($request->input('contrasena')),
                'email_verified_at'=> null,
                'remember_token'=>null,
                'created_at'=>$current_date_time,
                'updated_at'=> $current_date_time
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

            
            $usuario->save();
            DB::commit();
             
        }
         catch (\Exception $ex){dd($ex);
                                 DB::rollback();
                                 }
//hasta aqui
        return redirect()->route('administrador.administrador_usuarios');
    }

    
    public function formulario_usuarios_actualizar($usuario_id)
    {
        $usuario = Usuario::find($usuario_id);
       
        $usuario->email= $usuario->user->email;

        //dd($usuario->user->email);
        return view('administradores.administrador_usuarios.formulario_usuarios_actualizar', compact('usuario'));
    }
    
    public function usuarios_actualizar(Request $request,$usuario_id)
    {
        $validatedData = $request->validate([
                                                'nombre' => 'required',
                                                'cedula' => 'required',
                                                'telefono' => 'required',
                                                'direccion' => 'required',
                                                
                                                'email' => 'required',                                            
                                                //'email' => new UsuariosEmailRule        
                                            ]);
        try{DB::beginTransaction();
            $usuario = Usuario::find($usuario_id);

            $usuario->fill($request->all());

            $user = User::Find($usuario->user_id);

            $user->name = $request->input('nombre');
            $user->email = $request->input('email');
            if(!is_null($request->input('contrasena'))){
                $user->password = Hash::make($request->input('contrasena'));
            }
            
            $user->save();
            $usuario->save();
            DB::commit();
             
        }
         catch (\Exception $ex){dd($ex);
                                 DB::rollback();
                                 }





        
        
        // //Vincular correo a uno user registrado en el sistema
        // $user = User::Where('email',$request->input('email'))->get()->get(0);
       
        // $usuario->user_id = $user->id;

        

        return redirect()->route('administrador.administrador_usuarios');
    
    }


    public function formulario_correo_usuarios_actualizar( $usuario_id)
{
    
    $usuario = Usuario::find($usuario_id);
    
  
    return view('administradores.administrador_usuarios.formulario_correo_editar', compact('usuario'));
}






public function correo_usuarios_actualizar(Request $request, $usuario_id)
{
    try{DB::beginTransaction();
        $usuario = Usuario::find($usuario_id);

        $correo_nuevo = $request->input('email');
        $coreo_actual = $usuario->correo_user();

        //dd($coreo_actual,$correo_nuevo);
        $mensaje = 'Correo actualizado.';

        if( $correo_nuevo == $coreo_actual)
        {
                
            return redirect()->route('administrador.administrador_usuarios.formulario_usuarios_actualizar',$usuario_id)->with(['message'=> $mensaje,'tipo'=>'message']);
        }
        else if($correo_nuevo != $coreo_actual)
        {
                    $user = User::Where('email',$correo_nuevo)->get()->get(0);
                
                    if($correo_nuevo == ''){
                        $mensaje = 'Ingrese un Correo Electronico '.$correo_nuevo;
                        
                    }
                    else if(is_null($user))
                    {
                        $mensaje = 'No existe usuario registrado con el correo '.$correo_nuevo;
                        
                    }                
                    else if(!is_null($user->usuarios->get(0)))
                    {   
                        $usuario_nombre = $user->usuarios->get(0)->nombre;
                        $descripcion_tipo_usuario = $user->usuarios->get(0)->descripcion_tipo_usuario();
                        $mensaje = 'El correo '.$correo_nuevo.' se encuentra asociado al usuario '.$usuario_nombre.', dicho usuario es tipo '.$descripcion_tipo_usuario;
                    }
                    else if(is_null($user->usuarios->get(0)))
                    {
                        //Vincular correo a un user registrado en el sistema
                        
                        $usuario->user_id = $user->id;
                        $usuario->save();
                        return redirect()->route('administrador.administrador_usuarios.formulario_usuarios_actualizar',$usuario_id)->with(['message'=> $mensaje,'tipo'=>'message']);
                    }
                    
                    //dd($mensaje);
                    return redirect()->route('empresa.usuarios.formulario_correo_bodeguistas_actualizar',$usuario_id)->with(['message'=> $mensaje,'tipo'=>'error']);
        }
    DB::commit();
             
    }
    catch (\Exception $ex){dd($ex);
                            DB::rollback();
                            }

   //dd("aaaaa");
    return view('adminempresa.bodeguistas.formulario_correo_editar', compact('usuario'));
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
        
        //$empresa_carteras = Cartera::where('empresa_id',$empresa_id)->get();
        $carteras = Cartera::where('empresa_id',$empresa_id);

        $empresa_carteras=$carteras->where('tipo',1)->get();
        //dd($empresa_carteras);

        

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

        try{DB::beginTransaction();
            $cartera = new Cartera();
            $cartera->nombre = $request->input('nombre');
            $cartera->descripcion = $request->input('descripcion');
            $cartera->estado = 'A'; // A - Activo
            $cartera->empresa_id = $request->input('empresa_id');
            
            $cartera->tipo ='1';
            //$cartera->usuario_id = $request->input('usuario_id');
        

            $cartera->save();
            DB::commit();
             
        }
        catch (\Exception $ex){dd($ex);
                                DB::rollback();
                                }

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

        //dd($usuarios_empresa,$usuario_actual_cartera); 
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
        $empresa_id=$cartera->empresa_id;
        $cartera->estado = "A";
        $cartera->save();

        return redirect()->route('administrador.administrador_carteras',$empresa_id);
    }





 
}
