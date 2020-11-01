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
        
    
    App\User::create([
        'id'=>'15',
        'name' => 'Carterista prueba',
        'email' => 'sandokk.28@gmail.com',
        'password'=> '$2y$10$kW7VhFgnaJIs/O7ubjl4MOj/I1aqPYf7nP3YozCO6nNgUgzN8OKUC',
        'email_verified_at'=> null,
        'remember_token'=>null,
        'created_at'=>$current_date_time,
        'updated_at'=> $current_date_time
    ]);

    App\User::create([
        'id'=>'16',
        'name' => 'Empresa prueba',
        'email' => 'stivensrinconmoreno@gmail.com',
        'password'=> '$2y$10$kW7VhFgnaJIs/O7ubjl4MOj/I1aqPYf7nP3YozCO6nNgUgzN8OKUC',
        'email_verified_at'=> null,
        'remember_token'=>null,
        'created_at'=>$current_date_time,
        'updated_at'=> $current_date_time
    ]);

    App\User::create([
        'id'=>'17',
        'name' => 'Bodega prueba',
        'email' => 'bodega@gmail.com',
        'password'=> '$2y$10$kW7VhFgnaJIs/O7ubjl4MOj/I1aqPYf7nP3YozCO6nNgUgzN8OKUC',
        'email_verified_at'=> null,
        'remember_token'=>null,
        'created_at'=>$current_date_time,
        'updated_at'=> $current_date_time
    ]);
    App\User::create([
        'id'=>'18',
        'name' => 'Administrador prueba',
        'email' => 'administrador@gmail.com',
        'password'=> '$2y$10$kW7VhFgnaJIs/O7ubjl4MOj/I1aqPYf7nP3YozCO6nNgUgzN8OKUC',
        'email_verified_at'=> null,
        'remember_token'=>null,
        'created_at'=>$current_date_time,
        'updated_at'=> $current_date_time
    ]);


    App\Usuario::create([
        'id'=>'15',
        'nombre' => 'Sandok usuario',
        'cedula' => '11556699',
        'nit'=> '0',
        'telefono'=> '3213145588',
        'direccion'=>'CL 5b KR 8',
        'tipo'=>'3',
        'estado'=>'A',
        'user_id'=>'15',
        'empresa_id'=>'1',
        'created_at'=>$current_date_time,
        'updated_at'=> $current_date_time
    ]);

    App\Usuario::create([
        'id'=>'16',
        'nombre' => 'Empresa',
        'cedula' => '334536',
        'nit'=> '0',
        'telefono'=> '3213145208',
        'direccion'=>'CL 22 KR 15',
        'tipo'=>'2',
        'estado'=>'A',
        'user_id'=>'16',
        'empresa_id'=>'1',
        'created_at'=>$current_date_time,
        'updated_at'=> $current_date_time
    ]);

    App\Usuario::create([
        'id'=>'17',
        'nombre' => 'Bodega',
        'cedula' => '11556699',
        'nit'=> '0',
        'telefono'=> '3213145588',
        'direccion'=>'CL 5b KR 8',
        'tipo'=>'4',
        'estado'=>'A',
        'user_id'=>'17',
        'empresa_id'=>'1',
        'created_at'=>$current_date_time,
        'updated_at'=> $current_date_time
    ]);

    App\Usuario::create([
        'id'=>'18',
        'nombre' => 'Administrador',
        'cedula' => '11556699',
        'nit'=> '0',
        'telefono'=> '3213145588',
        'direccion'=>'CL 5b KR 8',
        'tipo'=>'1',
        'estado'=>'A',
        'user_id'=>'18',
        'created_at'=>$current_date_time,
        'updated_at'=> $current_date_time
    ]);
    
        

        


    }
}
