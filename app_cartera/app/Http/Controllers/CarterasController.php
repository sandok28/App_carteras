<?php

namespace App\Http\Controllers;

use App\Cartera;
use Illuminate\Http\Request;
use Auth;

class CarterasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = Auth::user();
             
        $carteras = $user->usuarios->get(0)->empresa->carteras;
       
        return view('carteras.index', compact('carteras'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('carteras.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cartera = new Cartera();
        $cartera->nombre = $request->input('nombre');
        $cartera->descripcion = $request->input('descripcion');
        $cartera->usuario_id = $request->input('usuario_id');
        $cartera->empresa_id = $request->input('empresa_id');
        $cartera->estado ='A';
        $cartera->save();

        return redirect('/carteras');
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
    public function edit(Cartera $cartera)
    {
        return view('carteras.edit', compact('cartera'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cartera $cartera)
    {
        $cartera->fill($request->all());
        $cartera->save();

        return redirect('/carteras');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cartera  $cartera
     * @return \Illuminate\Http\Response
     */
    public function desActivarCartera(Cartera $cartera)
    {
        $cartera->estado = "I";
        $cartera->save();

        return redirect('/carteras');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cartera  $cartera
     * @return \Illuminate\Http\Response
     */
    public function activarCartera(Cartera $cartera)
    {
        $cartera->estado = "A";
        $cartera->save();

        return redirect('/carteras');
    }
}
