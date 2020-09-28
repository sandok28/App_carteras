<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Producto;
use App\Empresa;
use App\Cartera;
use App\Usuario;
use App\User;
use Auth;
use App\Rules\CarteristasEmailRule;
use Illuminate\Support\Facades\DB;

class GestionEmpresasController extends Controller
{

//////////////////// CARTERAS DE LA EMPRESA ////////////////////  


    public function empresa_carteras() //vista de las carteras en el panel del administrador de la empresa
    {
        
        $user = Auth::user();
        $empresa_cartera = $user->usuarios->get(0)->empresa->carteras;
        //dd($empresa_cartera );
        return view('adminempresa.empresa_carteras')->with('empresa_carteras', $empresa_cartera);
                                                
    }


    public function formulario_carteras_actualizar($cartera_id)
    {
        
        $user = Auth::user();
        $empresa_id = $user->usuarios->get(0)->empresa_id;
        //dd($empresa_id);

        $usuarios_empresa_asignados = Cartera::where('empresa_id','=',$empresa_id)->pluck('usuario_id')->toArray();

        $usuarios_empresa_sin_asignados = Usuario::all()
                                            ->where('empresa_id','=',$empresa_id)
                                            ->where('estado','=','A')//Activo
                                            ->where('tipo','=','3')// 3 - Carterista
                                            ->whereNotIn('id',$usuarios_empresa_asignados)
                                            ->pluck('nombre', 'id');



       // dd($usuarios_empresa_sin_asignados);

        $usuarios_empresa_asignados = Cartera::where('empresa_id','=',$empresa_id)->select('usuario_id')->get();








        //dd($usuario_actual_cartera);

        $cartera = Cartera::find($cartera_id);

        $usuarios_empresa = Usuario::all()
                                      ->where('empresa_id','=',$empresa_id)
                                      ->where('estado','=','A')//Activo
                                      ->where('tipo','=','3')// 3 - Carterista
                                      
                                      ->pluck('nombre', 'id');

        //dd($usuarios_empresa);
        
        return view('adminempresa.carteras.formulario_carteras_actualizar' )->with('cartera',$cartera)
                                                                                            ->with('empresa_id',$empresa_id)
                                                                                            ->with('usuarios_empresa',$usuarios_empresa_sin_asignados);
    }


    public function carteras_actualizar(Request $request,$cartera_id)
    {

        
       

        $cartera = Cartera::find($cartera_id);

        $cartera->fill($request->all());

        $cartera->save();

        return redirect()->route('empresa.empresa_carteras'); 
    
    }

//////////////////// PRODUCTOS DE LA EMPRESA //////////////////// 

public function lista_productos()
    {

        $user = Auth::user();
        $empresa_id = $user->usuarios->get(0)->empresa_id;
        //dd($user);
        //
        $productos = Producto::all()->where('empresa_id','=',$empresa_id);
        //dd($empresa_id);
        //dd($productos);
        return view('adminempresa.empresa_productos', compact('productos'));
    }

    public function formulario_productos_crear()
    {
        return view('adminempresa.productos.formulario_productos_crear');
    }

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

        
        return redirect()->route('empresa.empresa_productos');
    }


    public function formulario_productos_actualizar($producto_id)
    {
        //dd($producto_id);
        $producto = Producto::find($producto_id);
        //dd($producto);
        return view('adminempresa.productos.formulario_productos_actualizar', compact('producto'));
    }

    public function productos_actualizar(Request $request, $producto_id)
    {
        $producto = Producto::find($producto_id);
        $producto->fill($request->all());
        $producto->save();
        return redirect()->route('empresa.empresa_productos');
    }

//////////////////// CARTERISTAS DE LA EMPRESA //////////////////// 


public function lista_carteristas()
    {
        $user = Auth::user();
        $empresa_id = $user->usuarios->get(0)->empresa_id;
        //dd($user);
        //
        $usuarios = Usuario::all()->where('empresa_id','=',$empresa_id)
                                  ->where('tipo','=',3);//  filtra los carteristas de la empresa
        
        //dd($empresa_id);
        //dd($usuarios);
        return view('adminempresa.empresa_carteristas', compact('usuarios'));
    }

    public function formulario_carteristas_crear()
    {
        return view('adminempresa.carteristas.formulario_carteristas_crear');
    }

    public function carteristas_crear(Request $request)
    {
        //
        $validatedData = $request->validate([
                                            'nombre' => 'required',
                                            'cedula' => 'required',
                                            'telefono' => 'required',
                                            'direccion' => 'required',
                                            'email' => new CarteristasEmailRule
                                            ]);
                                            
        $user = Auth::user();
        $usuario = new Usuario();

        $usuario->nombre = $request->input('nombre');
        $usuario->cedula = $request->input('cedula');
        $usuario->telefono = $request->input('telefono');
        $usuario->direccion = $request->input('direccion');
        $usuario->empresa_id = $user->usuarios->get(0)->empresa_id;
        $usuario->nit = '0';
        $usuario->user_id = '0';
        $usuario->tipo= '3';
        $usuario->estado ='A';

        //Vincular correo a un user registrado en el sistema
        $user = User::Where('email',$request->input('email'))->get()->get(0);     
        $usuario->user_id = $user->id;
        $usuario->save();

        
        return redirect()->route('empresa.empresa_carteristas');
    }

    public function formulario_carteristas_actualizar($usuario_id)
    {
        //dd($producto_id);
        $usuario = Usuario::find($usuario_id);
        //dd($producto);
        return view('adminempresa.carteristas.formulario_carteristas_actualizar', compact('usuario'));
    }   


    public function carteristas_actualizar(Request $request,$usuario_id)
        {

            $validatedData = $request->validate([
                                                'nombre' => 'required',
                                                'cedula' => 'required',
                                                'telefono' => 'required',
                                                'direccion' => 'required',          
                                                ]);

            $usuario = Usuario::find($usuario_id);
            //dd($usuario);
            $usuario->fill($request->all());
            //$user = User::Where('email',$request->input('email'))->get()->get(0);
            //dd($user,$request->input('email'));
            //$usuario->user_id = $user->id;

            $usuario->save();

            return redirect('/empresa/carteristas');
        
        }

        public function formulario_correo_carterista_actualizar( $usuario_id)
    {
        
        $usuario = Usuario::find($usuario_id);
        
      
        return view('adminempresa.carteristas.formulario_correo_editar', compact('usuario'));
    }

    public function correo_carterista_actualizar(Request $request, $usuario_id)
    {
        $usuario = Usuario::find($usuario_id);

        $correo_nuevo = $request->input('email');
        $coreo_actual = $usuario->correo_user();

        //dd($coreo_actual,$correo_nuevo);
        $mensaje = 'Correo actualizado.';

       if( $correo_nuevo == $coreo_actual)
       {
            
           return redirect()->route('empresa.empresa_carteristas.formulario.carteristas_actualizar',$usuario_id)->with(['message'=> $mensaje,'tipo'=>'message']);
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
                    return redirect()->route('empresa.empresa_carteristas.formulario.carteristas_actualizar',$usuario_id)->with(['message'=> $mensaje,'tipo'=>'message']);
                }
                
                //dd($mensaje);
                return redirect()->route('empresa.carterista.formulario_correo_carterista_actualizar',$usuario_id)->with(['message'=> $mensaje,'tipo'=>'error']);
       }


       //dd("aaaaa");
        return view('adminempresa.carteristas.formulario_correo_editar', compact('usuario'));
    }


    public function usuarios_desactivar($usuario_id)
        {

        //dd($usuario_id);
        $usuario = Usuario::find($usuario_id);
       // dd($usuario);
        $usuario->estado = "I";
        $usuario->save(); 

        return redirect('/empresa/carteristas');
        }
    public function usuarios_activar(Usuario $usuario)
        {
        $usuario->estado = "A";
        $usuario->save();

        return redirect('/empresa/carteristas');
        }
    
}
