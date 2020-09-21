<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()

    {

    $current_date_time = Carbon::now()->toDateTimeString(); // Produces something like "2019-03-11 12:25:00"
        App\Usuario::create([
            'id'=>'1',
            'nombre' => 'pepito1',
            'cedula' => '334536',
            'nit'=> '2222222',
            'telefono'=> '22222222',
            'direccion'=>'1',
            'tipo'=>'1',
            'estado'=>'A',
            'user_id'=>'1',
            'empresa_id'=>'1',

            'created_at'=>$current_date_time,
            'updated_at'=> $current_date_time
        ]);

        App\Usuario::create([
            'id'=>'2',
            'nombre' => 'carlos2',
            'cedula' => '334536',
            'nit'=> '2222222',
            'telefono'=> '22222222',
            'direccion'=>'1',
            'tipo'=>'1',
            'estado'=>'A',
            'user_id'=>'1',
            'empresa_id'=>'1',
            'created_at'=>$current_date_time,
            'updated_at'=> $current_date_time
        ]);

        App\Usuario::create([
            'id'=>'3',
            'nombre' => 'edwuin3',
            'cedula' => '334536',
            'nit'=> '2222222',
            'telefono'=> '22222222',
            'direccion'=>'1',
            'tipo'=>'1',
            'estado'=>'A',
            'user_id'=>'1',
            'empresa_id'=>'1',
            'created_at'=>$current_date_time,
            'updated_at'=> $current_date_time
        ]);

        App\Usuario::create([
            'id'=>'4',
            'nombre' => 'esteban4',
            'cedula' => '334536',
            'nit'=> '2222222',
            'telefono'=> '22222222',
            'direccion'=>'1',
            'tipo'=>'1',
            'estado'=>'A',
            'user_id'=>'1',
            'empresa_id'=>'1',
            'created_at'=> $current_date_time,
            'updated_at'=> $current_date_time
        ]);

        App\Usuario::create([
            'id'=>'5',
            'nombre' => 'carlos5',
            'cedula' => '334536',
            'nit'=> '2222222',
            'telefono'=> '22222222',
            'direccion'=>'1',
            'tipo'=>'1',
            'estado'=>'A',
            'user_id'=>'1',
            'empresa_id'=>'1',
            'created_at'=>$current_date_time,
            'updated_at'=> $current_date_time
        ]);


    }
}
