<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ErroresController extends Controller
{
    //
    public function registrarerrores($usuario_id, $controlador_metodo, $mensaje)
    {
        DB::table('log_errores')->insert(
            [
                'usuario_id'        => $usuario_id,
                'controlador_metodo'    => $controlador_metodo,
                'mensaje'    => $mensaje
            ]
        );
    }

}
