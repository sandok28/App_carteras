<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //dd('jjj');

        $user = Auth::user();
        $usuario_tipo = $user->usuarios->get(0)->tipo;


        switch ($usuario_tipo) {
            case '1':
                return redirect()->route('administrador.administrador_empresas'); 
                break;
            case '2':
                return redirect()->route('empresa.empresa_carteras');
                break;
            case '3':
                
                break;
        }


        


        return view('home');
    }
}

