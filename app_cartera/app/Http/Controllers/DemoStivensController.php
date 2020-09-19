<?php

namespace App\Http\Controllers;

use App\Devolucion;
use Illuminate\Http\Request;

class DemoStivensController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function inicio()
    {
        $devoluciones = Devolucion::all();
        return view('stivens.devoluciones.index', compact('devoluciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function formulario_devoluciones_crear()
    {
            return view('stivens.devoluciones.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function devoluciones_crear(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
}
