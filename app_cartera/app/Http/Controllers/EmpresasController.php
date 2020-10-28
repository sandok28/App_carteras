<?php

namespace App\Http\Controllers;

use App\Empresa;
use App\Producto;
use App\Cartera;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Rules\UsuariosEmailRule;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Usuario;

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
        try{
            DB::beginTransaction();
            //dd($request);
            Empresa::create([
                'nombre'=>$request->nombre,
                'descripcion'=>$request->descripcion,
                'telefono'=>$request->telefono
        
            ]);

            $ultima_empresa = DB::table('empresas')
                ->select('id','nombre')
                ->orderBy('created_at', 'desc')
                ->first();
            
                
            Cartera::create([
                'nombre'=>'lista negra',
                'descripcion'=>'lista de las personas que le deben a la empresa '.$ultima_empresa->nombre,
                'estado'=>'A',
                'empresa_id'=>$ultima_empresa->id,
                'usuario_id'=>'0',
                'tipo'=>'2'       
            ]);
            
            $listanegra = DB::table('carteras')
                ->orderBy('created_at', 'desc')
                ->first();

            Cartera::create([
                'nombre'=>'lista clientes inactivos',
                'descripcion'=>'lista de las personas sin deudas que no volvieron a comprar a la empresa '.$ultima_empresa->nombre,
                'estado'=>'A',
                'empresa_id'=>$ultima_empresa->id,
                'usuario_id'=>'0',
                'tipo'=>'3'       
            ]);
            
            $listainactivos = DB::table('carteras')
                ->orderBy('created_at', 'desc')
                ->first();



                $validatedData = $request->validate([
                    'nombre' => 'required',
                    'cedula' => 'required',
                    'telefono' => 'required',
                    'direccion' => 'required',
                    'contrasena' => 'required',
                    'email' => 'required',
                    'email' => new UsuariosEmailRule 
                    ]);

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


                $empresa=Empresa::where('nombre',$request->nombre);            
                $user = Auth::user();
                $usuario = new Usuario();

                $usuario->nombre = $request->input('nombre');
                $usuario->cedula = $request->input('cedula');
                $usuario->telefono = $request->input('telefono');
                $usuario->direccion = $request->input('direccion');
                $usuario->empresa_id = $empresa->first()->id;
                $usuario->nit = '0';
                $usuario->user_id = '0';
                $usuario->tipo= '2';
                $usuario->estado ='A';

                //Vincular correo a un user registrado en el sistema
                $user = User::Where('email',$request->input('email'))->get()->get(0);     
                $usuario->user_id = $user->id;
                $usuario->save();    

                
                //dd($empresa->first()->id);

            //dd($listainactivos);
            DB::commit(); //////->SAVE
        }
        catch (\Exception $ex){dd($ex);
            DB::rollback();

        }

        return redirect()->route('administrador.administrador_empresas');
    }

    public function formulario_empresas_actualizar($empresa_id)
    {
        
       
        $empresa = Empresa::find($empresa_id);

        $usuario = Usuario::where('empresa_id',$empresa_id)->where('tipo',2)->get()->get(0);
        $empresa->cedula=$usuario->cedula;
        $empresa->direccion=$usuario->direccion;
        $empresa->email=$usuario->user->email;
        

        return view('administradores.administrador_empresas.formulario_empresas_actualizar')->with('empresa',$empresa)->with('usuario',$usuario);
    }

    public function empresas_actualizar(Request $request, $empresa_id)
    {
        //dd($request);
        $validatedData = $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'telefono' => 'required'
            ]);

        try{DB::beginTransaction();
            $empresa = Empresa::find($empresa_id);
            $empresa->fill($request->all());
            $empresa->telefono = $request->input('telefono');
            $empresa->save();

            $usuario = Usuario::where('empresa_id',$empresa_id)->where('tipo',2)->get()->get(0);
            $usuario->cedula=($request->cedula);
            $usuario->direccion=($request->direccion);
            $usuario->save();

            $user=User::where('id',$usuario->user_id)->get()->get(0);
            //dd($request->input('contrasena'));
            $user->email=($request->email);
            
            if(!is_null($request->input('contrasena'))){
                $user->password = Hash::make($request->input('contrasena'));
            }
            $user->save();
            //dd($usuario->user->email);
            
            
            //dd($usuario);


        DB::commit();
             
         }
         catch (\Exception $ex){dd($ex);
                                 DB::rollback();
                                 }

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



