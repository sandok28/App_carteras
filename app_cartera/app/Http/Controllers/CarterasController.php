<?php

namespace App\Http\Controllers;

use App\Cartera;
use Illuminate\Http\Request;
use Auth;
use App\User;

class CarterasController extends Controller


{
    
    public function inicio()
    {
        $carteras = Cartera::all();
        return view('carteras.index', compact('carteras')); 
    }



    
    public function formulario_carteras_crear()               
    {             
        return view('carteras.create');
    }




    public function carteras_crear(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required',
            'usuario_id' => 'required',
            'empresa_id' => 'required'
            
            ]);
        $user = Auth::user();
        $cartera = new Cartera();
        $cartera->nombre = $request->input('nombre');
        $cartera->descripcion = $request->input('descripcion');
        $cartera->usuario_id = $request->input('usuario_id');
        $cartera->empresa_id = $request->input('empresa_id');
        $cartera->estado ='A';
        $cartera->save();

        return redirect('/carteras');
    }


    public function formulario_carteras_actualizar( $cartera_id)
    
    {
        //dd($cartera_id);
        $cartera = Cartera::find($cartera_id);
        return view('carteras.edit', compact('cartera'));
    }


    public function carteras_actualizar(Request $request, $cartera_id)
    {
        $cartera = Cartera::find($cartera_id);
        $cartera->fill($request->all());
        $cartera->save();

        return redirect('/carteras');
    }



    public function desActivarCartera(Cartera $cartera)
    {
        $cartera->estado = "I";
        $cartera->save();

        return redirect('/carteras');
    }




    public function activarCartera(Cartera $cartera)
    {
        $cartera->estado = "A";
        $cartera->save();

        return redirect('/carteras');
    }

 }
