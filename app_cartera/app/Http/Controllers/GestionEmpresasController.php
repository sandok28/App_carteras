<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\HistorialVentaCartera;
use App\Producto;
use App\Empresa;
use App\Cartera;
use App\Usuario;
use App\Cliente;
use App\ListaNegraCliente;
use App\Bono;
use App\Novedad;
use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Rules\UsuariosEmailRule;
use Illuminate\Support\Facades\DB;

class GestionEmpresasController extends Controller
{

//////////////////// CARTERAS DE LA EMPRESA ////////////////////  


    public function empresa_carteras() //vista de las carteras en el panel del administrador de la empresa
    {
        
        $user = Auth::user();
        //$empresa_cartera = $user->usuarios->get(0)->empresa->carteras;
        $empresa_id = $user->usuarios->get(0)->empresa_id;////// id de la empresa del usuario logueado
        $carteras = Cartera::where('empresa_id',$empresa_id);////// carteras de la empresa del usuario logueado
        $empresa_cartera=$carteras->where('tipo',1)->get();////// filtro de las carteras tipo 1
        //dd($empresa_cartera);
        return view('adminempresa.empresa_carteras')->with('empresa_carteras', $empresa_cartera);
                                                
    }


    public function formulario_carteras_actualizar($cartera_id)
    {
        
        //dd($dias);
        $user = Auth::user();
        $empresa_id = $user->usuarios->get(0)->empresa_id;
        $empresa_id_cartera=Cartera::find($cartera_id)->empresa_id;//////empresa a la cual pertenece la cartera
        //dd($empresa_id);



        if($empresa_id == $empresa_id_cartera)
            {
                //$usuarios_empresa_asignados = Cartera::where('empresa_id','=',$empresa_id)->pluck('usuario_id')->toArray();

        $usuarios_empresa_sin_asignados = Usuario::all()
                                            ->where('empresa_id','=',$empresa_id)
                                            ->where('estado','=','A')//Activo
                                            ->where('tipo','=','3')// 3 - Carterista
                                            //->whereNotIn('id',$usuarios_empresa_asignados)
                                            ->pluck('nombre', 'id');

       // dd($usuarios_empresa_sin_asignados);

        //$usuarios_empresa_asignados = Cartera::where('empresa_id','=',$empresa_id)->select('usuario_id')->get();

        //dd($usuario_actual_cartera);

        $cartera = Cartera::find($cartera_id);

        $usuarios_empresa = Usuario::all()
                                      ->where('empresa_id','=',$empresa_id)
                                      ->where('estado','=','A')//Activo
                                      ->where('tipo','=','3')// 3 - Carterista
                                      ->pluck('nombre', 'id');

        //dd($usuarios_empresa);
        
        $dia1 = DB::table('cartera_dia')->where('cartera_id',$cartera_id)->where('dia_id',1)->get()->all();
        
        if(empty($dia1)){
            $dia1_id=0;
        }else{$dia1_id=1;}
                
        $dia2 = DB::table('cartera_dia')->where('cartera_id',$cartera_id)->where('dia_id',2)->get()->all();
        
        if(empty($dia2)){
            $dia2_id=0;
        }else{$dia2_id=1;}

        $dia3 = DB::table('cartera_dia')->where('cartera_id',$cartera_id)->where('dia_id',3)->get()->all();
        
        if(empty($dia3)){
            $dia3_id=0;
        }else{$dia3_id=1;}

        $dia4 = DB::table('cartera_dia')->where('cartera_id',$cartera_id)->where('dia_id',4)->get()->all();
        
        if(empty($dia4)){
            $dia4_id=0;
        }else{$dia4_id=1;}

        $dia5 = DB::table('cartera_dia')->where('cartera_id',$cartera_id)->where('dia_id',5)->get()->all();

        if(empty($dia5)){
            $dia5_id=0;
        }else{$dia5_id=1;}

        $dia6 = DB::table('cartera_dia')->where('cartera_id',$cartera_id)->where('dia_id',6)->get()->all();
        
        if(empty($dia6)){
            $dia6_id=0;
        }else{$dia6_id=1;}
        
        $dia7 = DB::table('cartera_dia')->where('cartera_id',$cartera_id)->where('dia_id',7)->get()->all();
        //dd($dia7);
        if(empty($dia7)){
            $dia7_id=0;
        }else{$dia7_id=1;}
        //dd($dia1_id,$dia2_id,$dia3_id,$dia4_id,$dia5_id,$dia6_id,$dia7_id);
        
           //dd($var_aux);

            
        
        return view('adminempresa.carteras.formulario_carteras_actualizar' )->with('cartera',$cartera)
                                                                                            ->with('empresa_id',$empresa_id)
                                                                                            ->with('usuarios_empresa',$usuarios_empresa_sin_asignados)
                                                                                            ->with('dia1_id',$dia1_id)
                                                                                            ->with('dia2_id',$dia2_id)
                                                                                            ->with('dia3_id',$dia3_id)
                                                                                            ->with('dia4_id',$dia4_id)
                                                                                            ->with('dia5_id',$dia5_id)
                                                                                            ->with('dia6_id',$dia6_id)
                                                                                            ->with('dia7_id',$dia7_id);
    }
            

            else {
                return redirect('xxx');
            }

        }
    public function carteras_actualizar(Request $request,$cartera_id)
    {
        //dd($request);
        try{DB::beginTransaction();
        $cartera = Cartera::find($cartera_id);
        //dd($cartera);
        $cartera->fill($request->all());
        
        
        DB::table('cartera_dia')->where(['cartera_id' => $cartera_id])->delete();   
        
        if(($request->input('1'))=='value'){
            DB::insert('insert into cartera_dia (cartera_id, dia_id) values (?, ?)', [$cartera_id, 1]);
        }

        if(($request->input('2'))=='value'){
            DB::insert('insert into cartera_dia (cartera_id, dia_id) values (?, ?)', [$cartera_id, 2]);
        }

        if(($request->input('3'))=='value'){
            DB::insert('insert into cartera_dia (cartera_id, dia_id) values (?, ?)', [$cartera_id, 3]);
        }

        if(($request->input('4'))=='value'){
            DB::insert('insert into cartera_dia (cartera_id, dia_id) values (?, ?)', [$cartera_id, 4]);
        }

        if(($request->input('5'))=='value'){
            DB::insert('insert into cartera_dia (cartera_id, dia_id) values (?, ?)', [$cartera_id, 5]);
        }

        if(($request->input('6'))=='value'){
            DB::insert('insert into cartera_dia (cartera_id, dia_id) values (?, ?)', [$cartera_id, 6]);
        }

        if(($request->input('7'))=='value'){
            DB::insert('insert into cartera_dia (cartera_id, dia_id) values (?, ?)', [$cartera_id, 7]);
        }
        

        $cartera->save();


        //$cartera_dia = new Dia();




        DB::commit();
        }
        catch (\Exception $ex){dd($ex);
                                DB::rollback();
                                }

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
        
        $validatedData = $request->validate([
        'nombre' => 'required',
        'precio' => 'required',
        'descripcion' => 'required'
        
        ]);

        try{DB::beginTransaction();
           
            //contenido del codigo a proteger
            $user = Auth::user();
            $producto = new Producto();
            $producto->nombre = $request->input('nombre');
            $producto->precio = $request->input('precio');
            $producto->cantidad = '0';
            $producto->empresa_id = $user->usuarios->get(0)->empresa_id;
            $producto->descripcion = $request->input('descripcion');
            $producto->estado ='A';
            $producto->save();
            DB::commit();

        // //DB::commit();
         }
        catch (\Exception $ex){dd($ex);
                                DB::rollback();
                                }
        

        

        
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
        try{DB::beginTransaction();
            $producto = Producto::find($producto_id);
            $producto->fill($request->all());
            $producto->save();
            DB::commit();
            }
        catch (\Exception $ex){dd($ex);
                                DB::rollback();
                                }
        return redirect()->route('empresa.empresa_productos');
    }

    public function formulario_productos_agregar($producto_id)
    {
        //dd($producto_id);
        $producto = Producto::find($producto_id);
        //dd($producto);
        return view('adminempresa.productos.formulario_productos_agregar', compact('producto'));
    }

    // public function formulario_productos_agregar($producto_id)
    // {
    //     $producto = Producto::find($producto_id);
    //     return view('adminempresa.productos.formulario_productos_agregar')->with('producto',$producto);
    // }

    public function productos_agregar(Request $request, $producto_id)
    {
        //dd($request);
        // try{DB::beginTransaction();
        //      contenido del codigo a proteger
        //     DB::commit();
        //     
        // }
        // catch (\Exception $ex){dd($ex);
        //                         DB::rollback();
        //                         }

        $producto = Producto::find($producto_id);
        
        try{DB::beginTransaction();
            $cantproductoact=(($producto->cantidad)+($request->cantidad1));
            //dd($cantproductoact);
            $affected = DB::update('update productos set cantidad = ? where id = ?', [$cantproductoact, $producto_id]);

            DB::commit();
            //contenido
        }
        catch (\Exception $ex){dd($ex);
                                DB::rollback();
                                }
        
        
        //$producto->save();
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
                                            'contrasena' => 'required',
                                            'email' => 'required', 
                                            'email' => new UsuariosEmailRule
                                            ]);

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
        DB::commit();
             
         }
         catch (\Exception $ex){dd($ex);
            DB::rollback();
            }

        
        return redirect()->route('empresa.empresa_carteristas');
    }

    public function formulario_carteristas_actualizar($usuario_id)
    {
        //dd($producto_id);
        $usuario = Usuario::find($usuario_id);
        //dd($producto);
        $usuario->email= $usuario->user->email;

        return view('adminempresa.carteristas.formulario_carteristas_actualizar', compact('usuario'));
    }   


    public function carteristas_actualizar(Request $request,$usuario_id)
        {

            $validatedData = $request->validate([
                                                'nombre' => 'required',
                                                'cedula' => 'required',
                                                'telefono' => 'required',
                                                'direccion' => 'required',
                                                'email' => 'required',           
                                                ]);
            try{DB::beginTransaction();
                $usuario = Usuario::find($usuario_id);
                //dd($usuario);
                $usuario->fill($request->all());
                //$user = User::Where('email',$request->input('email'))->get()->get(0);
                //dd($user,$request->input('email'));
                //$usuario->user_id = $user->id;
                $user = User::Find($usuario->user_id);

                $user->name = $request->input('nombre');
                $user->email = $request->input('email');
                if(!is_null($request->input('contrasena'))){
                    $user->password = Hash::make($request->input('contrasena'));
                }
                
                $user->save();
                DB::commit();
             
            }
            catch (\Exception $ex){dd($ex);
                DB::rollback();
                }


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
        try{DB::beginTransaction();
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
        }
        catch (\Exception $ex){dd($ex);
                                DB::rollback();
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


//////////////////// CLIENTES DE LA EMPRESA //////////////////// 

    public function lista_clientes($cartera_id)
        {
            //dd($cartera_id);
            $user = Auth::user();
            $empresa_id = $user->usuarios->get(0)->empresa_id;/////// empresa a la que pertenece el usuario logueado


            $cartera_empresa_id= Cartera::find($cartera_id)->empresa_id;
            //dd($cartera_empresa_id, $empresa_id);

            if($empresa_id == $cartera_empresa_id)
            {
                $clientes = Cliente::all()->where('cartera_id','=',$cartera_id);
            }

            else {
                return("error");
            }
            
            //dd($clientes);
            return view('adminempresa.empresa_clientes', compact('clientes'));
        }

    public function formulario_cliente_actualizar( $cliente_id)
        {

            $user = Auth::user();
            $empresa_id = $user->usuarios->get(0)->empresa_id; /////// empresa a la que pertenece el usuario logueado

            $cliente = Cliente::find($cliente_id);////// datos del cliente que se va a modificar
            //dd($cliente);
            $cartera_cliente=$cliente->cartera_id;//////cartera a la cual pertenece el cliente
            //dd($cliente_cartera);
            $empresa_id_cartera=Cartera::find($cartera_cliente)->empresa_id;//////empresa a la cual pertenece la cartera
            //dd($empresa_id_cartera);
            
            //dd($producto);
            if($empresa_id == $empresa_id_cartera)
            {
                return view('adminempresa.clientes.formulario_clientes_actualizar', compact('cliente'));
            }

            else {
                return redirect('xxx');
            }
            //return view('adminempresa.clientes.formulario_clientes_actualizar', compact('cliente'));
    } 

    public function cliente_actualizar(Request $request,$cliente_id)
        {
            //dd($request,$cliente_id);


            $validatedData = $request->validate([
                                                'nombre' => 'required',
                                                'cedula' => 'required',
                                                'telefono' => 'required',
                                                'direccion' => 'required',          
                                                ]);
            try{DB::beginTransaction();

                $cliente = Cliente::find($cliente_id);

                //dd($cliente);
                $cliente->fill($request->all());
                //dd($cliente);
                //$user = User::Where('email',$request->input('email'))->get()->get(0);
                //dd($user,$request->input('email'));
                //$usuario->user_id = $user->id;

                $cliente->save();
                DB::commit();
                
            }
            catch (\Exception $ex){dd($ex);
                DB::rollback();
                }

            return redirect('/empresa/empresa_carteras');
        }
//////Lista negra de la empresa////////////////////

    public function lista_negra_clientes()
    {
        $user = Auth::user();
        $empresa_id = $user->usuarios->get(0)->empresa_id;///////id de la empresa a la que pertenece el usuario logueado


        $lista_negra= Cartera::all()->where('tipo',2)->where('empresa_id',$empresa_id);//////cartera lista negra de la empresa
        //dd($lista_negra);
        foreach ($lista_negra as $id){
        $lista_negra_id=$id->id;
        }

        $clientesP = Cliente::all()->where('cartera_id','=',$lista_negra_id)
                                  ->where('estado','=','LNP');

        $clientesC = Cliente::all()->where('cartera_id','=',$lista_negra_id)
                                   ->where('estado','=','LNC');


        return view('adminempresa.empresa_LN', compact('clientesP','clientesC'));
    }

    public function formulario_cliente_listanegra_actualizar($cliente_id)
        {
            $user = Auth::user();
            $empresa_id = $user->usuarios->get(0)->empresa_id;///////id de la empresa a la que pertenece el usuario logueado

            $empresa_carteras= Cartera::where('empresa_id',$empresa_id)->where('tipo',1)->pluck('nombre','id');////// nombre de las carteras de la empresa
            //dd($empresa_carteras);
            $cliente = Cliente::find($cliente_id);
            //dd($cliente);
            return view('adminempresa.listanegra.formulario_clientes_listanegra_actualizar', compact('cliente','empresa_carteras'));
        }

        public function cliente_listanegra_actualizar(Request $request,$cliente_id)
        {
            //dd($request,$cliente_id);
            $validatedData = $request->validate([                        
                                                'cartera_id' => 'required',
                                                ]);
            try{DB::beginTransaction();
            $cliente = Cliente::find($cliente_id);

            //dd($cliente);
            $cliente->fill($request->all());
            $cliente->estado='A';
            //dd($cliente);

            $cliente->save();
            DB::commit();
             
         }
         catch (\Exception $ex){dd($ex);
                                 DB::rollback();
                                 }

            return redirect('/empresa/listanegra');
        }

        public function cliente_listanegraP_confirmar($cliente_id)//////pasar el cliente de la lista negra de pendiente a confirmado
        {
            //dd($cliente_id);
            //dd($request,$cliente_id);
            try{DB::beginTransaction();
            $user = Auth::user();
            $empresa_id = $user->usuarios->get(0)->empresa_id;///////id de la empresa a la que pertenece el usuario logueado

            $cliente = Cliente::find($cliente_id);
            $cliente->estado='LNC';
            //dd($cliente);
           
            
            //dd($cliente);

            $cliente->save();
            DB::commit();
             
         }
         catch (\Exception $ex){dd($ex);
                                 DB::rollback();
                                 }

            return redirect('/empresa/listanegra');
        }


    //////Lista inactivos de la empresa////////////////////

    public function lista_inactivos_clientes()
    {
        $user = Auth::user();
        $empresa_id = $user->usuarios->get(0)->empresa_id;///////id de la empresa a la que pertenece el usuario logueado


        $lista_inactivos= Cartera::all()->where('tipo',3)->where('empresa_id',$empresa_id);//////cartera lista inactivos de la empresa
        //dd($lista_inactivos);
        foreach ($lista_inactivos as $id){
        $lista_inactivos_id=$id->id;
        }

        $clientesI = Cliente::all()->where('cartera_id','=',$lista_inactivos_id)
                                  ->where('estado','=','LI');


        return view('adminempresa.empresa_LI', compact('clientesI'));
    }

    public function formulario_cliente_listainactivos_actualizar($cliente_id)
    {
        $user = Auth::user();
        $empresa_id = $user->usuarios->get(0)->empresa_id;///////id de la empresa a la que pertenece el usuario logueado

        $empresa_carteras= Cartera::where('empresa_id',$empresa_id)->where('tipo',1)->pluck('nombre','id');////// nombre de las carteras de la empresa
        //dd($empresa_carteras);
        $cliente = Cliente::find($cliente_id);
        //dd($cliente);
        return view('adminempresa.lista_inactivos.formulario_clientes_listainactivos_actualizar', compact('cliente','empresa_carteras'));
    }

    public function cliente_listainactivos_actualizar(Request $request,$cliente_id)
        {
            //dd($request,$cliente_id);
            $validatedData = $request->validate([                        
                                                'cartera_id' => 'required',
                                                ]);

            $cliente = Cliente::find($cliente_id);

            //dd($cliente);
            $cliente->fill($request->all());
            $cliente->estado='A';
            //dd($cliente);

            $cliente->save();

            return redirect('/empresa/listainactivos');
        }

        public function bonos($cartera_id) 
        {
            
            $user = Auth::user();
            $empresa_id = $user->usuarios->get(0)->empresa_id;////// id de la empresa del usuario logueado
            $bonos = Bono::where('cartera_id',$cartera_id)->get();////// bonos de la cartera
            //dd($carteras);
            
            return view('adminempresa.empresa_bonos')->with('bonos', $bonos);
                                                    
        }

        public function novedades($cartera_id) 
        {
            $novedades = Novedad::where('cartera_id',$cartera_id)->get();////// bonos de la cartera
            //dd($carteras);
            
            return view('adminempresa.empresa_novedades')->with('novedades', $novedades);
                                                    
        }




//////////////////// BODEGUISTAS DE LA EMPRESA //////////////////// 


public function lista_bodeguistas()
{
    $user = Auth::user();
    $empresa_id = $user->usuarios->get(0)->empresa_id;
    //dd($user);
    //
    $usuarios = Usuario::all()->where('empresa_id','=',$empresa_id)
                              ->where('tipo','=',4);//  filtra los carteristas de la empresa
    
    //dd($empresa_id);
    //dd($usuarios);
    return view('adminempresa.empresa_bodeguistas', compact('usuarios'));
}

public function formulario_bodeguistas_crear()
{
    return view('adminempresa.bodeguistas.formulario_bodeguistas_crear');
}

public function bodeguistas_crear(Request $request)
{
    //
    $validatedData = $request->validate([
                                        'nombre' => 'required',
                                        'cedula' => 'required',
                                        'telefono' => 'required',
                                        'direccion' => 'required',
                                        'contrasena' => 'required',
                                        'email' => 'required',
                                        'email' => new UsuariosEmailRule 
                                        ]);

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


                                    
        $user = Auth::user();
        $usuario = new Usuario();

        $usuario->nombre = $request->input('nombre');
        $usuario->cedula = $request->input('cedula');
        $usuario->telefono = $request->input('telefono');
        $usuario->direccion = $request->input('direccion');
        $usuario->empresa_id = $user->usuarios->get(0)->empresa_id;
        $usuario->nit = '0';
        $usuario->user_id = '0';
        $usuario->tipo= '4';
        $usuario->estado ='A';

        //Vincular correo a un user registrado en el sistema
        $user = User::Where('email',$request->input('email'))->get()->get(0);     
        $usuario->user_id = $user->id;
        $usuario->save();
        DB::commit();
             
        }
         catch (\Exception $ex){dd($ex);
                                 DB::rollback();
                                 }

    
    return redirect()->route('empresa.bodeguistas');
}

public function formulario_bodeguistas_actualizar($usuario_id)
{
    //dd($producto_id);
    $usuario = Usuario::find($usuario_id);
    //dd($producto);
    $usuario->email= $usuario->user->email;

    return view('adminempresa.bodeguistas.formulario_bodeguistas_actualizar', compact('usuario'));
}   


public function bodeguistas_actualizar(Request $request,$usuario_id)
    {

        $validatedData = $request->validate([
                                            'nombre' => 'required',
                                            'cedula' => 'required',
                                            'telefono' => 'required',
                                            'direccion' => 'required', 
                                            'email' => 'required',           
                                            ]);
        try{DB::beginTransaction();

            $usuario = Usuario::find($usuario_id);
            //dd($usuario);
            $usuario->fill($request->all());
            //$user = User::Where('email',$request->input('email'))->get()->get(0);
            //dd($user,$request->input('email'));
            //$usuario->user_id = $user->id;
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

        return redirect('/empresa/bodeguistas');
    
    }

    public function formulario_correo_bodeguistas_actualizar( $usuario_id)
{
    
    $usuario = Usuario::find($usuario_id);
    
  
    return view('adminempresa.bodeguistas.formulario_correo_editar', compact('usuario'));
}

public function correo_bodeguistas_actualizar(Request $request, $usuario_id)
{
    try{DB::beginTransaction();

            $usuario = Usuario::find($usuario_id);

            $correo_nuevo = $request->input('email');
            $coreo_actual = $usuario->correo_user();

            //dd($coreo_actual,$correo_nuevo);
            $mensaje = 'Correo actualizado.';

        if( $correo_nuevo == $coreo_actual)
        {
                
            return redirect()->route('empresa.bodeguistas.formulario.bodeguistas_actualizar',$usuario_id)->with(['message'=> $mensaje,'tipo'=>'message']);
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
                        return redirect()->route('empresa.bodeguistas.formulario.bodeguistas_actualizar',$usuario_id)->with(['message'=> $mensaje,'tipo'=>'message']);
                    }
                    
                    //dd($mensaje);
                    return redirect()->route('empresa.bodeguistas.formulario_correo_bodeguistas_actualizar',$usuario_id)->with(['message'=> $mensaje,'tipo'=>'error']);
        }
    }
    catch (\Exception $ex){dd($ex);
                            DB::rollback();
                            }


   //dd("aaaaa");
    return view('adminempresa.bodeguistas.formulario_correo_editar', compact('usuario'));
}


public function usuarios4_desactivar($usuario_id)
    {

    //dd($usuario_id);
    $usuario = Usuario::find($usuario_id);
   // dd($usuario);
    $usuario->estado = "I";
    $usuario->save(); 

    return redirect('/empresa/bodeguistas');
    }
public function usuarios4_activar(Usuario $usuario)
    {
    $usuario->estado = "A";
    $usuario->save();

    return redirect('/empresa/bodeguistas');
    }

    public function ventas($cartera_id)
    {
        //dd($cartera_id);
        //$ventas=HistorialVentaCartera::where('cartera_id',$cartera_id)->get();
        $ventas = DB::table('historial_venta_carteras')->where('cartera_id',$cartera_id)->orderBy('fecha','desc')->get();
        //dd($ventas->get()->all());
        return view('adminempresa.empresa_ventas', compact('ventas'));

    
    }

    
}
