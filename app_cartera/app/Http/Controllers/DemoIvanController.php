<?php

namespace App\Http\Controllers;
use App\Bono;
use App\Novedad;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\ListaNegra;
class DemoIvanController extends Controller
{
    
    public function inicio()
    {
        $novedades = Novedad::all();
        
       return view('ivan.novedades.inicio', compact('novedades')); 
    }

    public function inicio2()
    {
        $bonos = Bono::all();
    
        
       return view('ivan.bonos.inicio', compact('bonos')); 
    }
    

    
    public function formulario_novedades_crear()               
    {             
        return view('ivan.novedades.crear',);
    }



    public function formulario_bonos_crear()               
    {             
        return view('ivan.bonos.crear',);
    }


//////////////////////// * Muestre el formulario para crear un nuevo recurso.///////////

    public function novedades_crear(Request $request)
    {
        
        $user = Auth::user();
        $novedad = new Novedad();
        $novedad->cartera_id = $request->input('cartera_id');
        $novedad->novedad = $request->input('novedad');


        $novedad->usuario_nombre = $request->input('usuario_nombre');
        $novedad->mi_fecha = $request->input('mi_fecha');
        $novedad->save();

        return redirect('/novedades');
    }

    public function bonos_crear(Request $request)
    {
        

        //dd('fff');
        $user = Auth::user();
        $bono = new Bono();
        $bono->cartera_id = $request->input('cartera_id');
        $bono->descripcion = $request->input('descripcion');
        $bono->mi_fecha = $request->input('mi_fecha');
        $bono->valor = $request->input('valor');
        $bono->save();

        return redirect('/bonos');
    }

    ////////////////////// * Mostrar el formulario para editar el recurso especificado

    public function formulario_novedades_actualizar($novedad_id)
    
    {
        //dd($novedad_id);
        $novedad = Novedad::find($novedad_id);
        return view('ivan.novedades.editar', compact('novedad'));
    }

    public function formulario_bonos_actualizar($bono_id)
    
    {
        //dd($novedad_id);
        $bono = Bono::find($bono_id);
        return view('ivan.bonos.editar', compact('bono'));
    }


//////////////// * Actualizar el recurso especificado en el almacenamiento./////////////////////


    public function noveadades_actualizar(Request $request, $novedad_id)
    {
        $novedad = Novedad::find($novedad_id);
        $novedad->fill($request->all());
        $novedad->save();

        return redirect('/novedades');
    }


    public function bonos_actualizar(Request $request, $bono_id)
    {
        $bono = Bono::find($bono_id);
        $bono->fill($request->all());
        $bono->save();

        return redirect('/bonos');
    }




    public function listanegras_actualizar(Request $request, $listanegras_id)
    {
        $listanegras = ListaNegra::find($listanegras_id);
        $listanegras->fill($request->all());
        $listanegras->save();

        return redirect('/listanegras');
    }

    


 ////////7///////*Elimina el recurso especificado del almacenamiento.////////////////////
     
     public function eliminar($id)
     {
         //
     }





    public function desActivarLista($listanegra)
    {
        
        $listanegra = ListaNegra::find($listanegra);

        //dd($listanegra);
        $listanegra->estado = "P";
        $listanegra->save();

        return redirect('/listanegras');
    }



    public function desActivarCartera(Cartera $Cartera)
    {
        $demoivan->estado = "I";
        $demoivan->save();

        return redirect('/carteras');
    }





    public function activarCartera(Cartera $demoivan)
    {
        $demoivan->estado = "A";
        $demoivan->save();

        return redirect('/carteras');
    }





    public function activarLista($demoivan)
    {

        $listanegra = ListaNegra::find($demoivan);

        //dd($listanegra);
        $listanegra->estado = "C";
        $listanegra->save();

        return redirect('/listanegras');
    }






 }
