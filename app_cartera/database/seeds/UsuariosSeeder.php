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
        'name' => 'sandokk.28',
        'email' => 'sandokk.28@gmail.com',
        'password'=> '$2y$10$sgqJ.0Pog0RyAzLw.C0B7.8SYr//hyGbtHOi.pSoQ3nX/D6s9IqOS',
        'email_verified_at'=> null,
        'remember_token'=>null,
        'created_at'=>$current_date_time,
        'updated_at'=> $current_date_time
    ]);

    App\User::create([
        'id'=>'16',
        'name' => 'STIVENS RINCON MORENO',
        'email' => 'stivensrinconmoreno@gmail.com',
        'password'=> '$2y$10$kW7VhFgnaJIs/O7ubjl4MOj/I1aqPYf7nP3YozCO6nNgUgzN8OKUC',
        'email_verified_at'=> null,
        'remember_token'=>null,
        'created_at'=>$current_date_time,
        'updated_at'=> $current_date_time
    ]);
    
    
        App\Usuario::create([
            'id'=>'1',
            'nombre' => 'Edwin Sandoval',
            'cedula' => '334536',
            'nit'=> '0',
            'telefono'=> '3213145208',
            'direccion'=>'CL 22 KR 15',
            'tipo'=>'1',
            'nombre' => 'PEDRO1',
            'cedula' => '111111',
            'nit'=> '111111',
            'telefono'=> '111111',
            'direccion'=>'111111',
            'tipo'=>'3',
            'estado'=>'A',
            'user_id'=>'1',
            'empresa_id'=>'1',
            'created_at'=>$current_date_time,
            'updated_at'=> $current_date_time
        ]);

        App\Usuario::create([
            'id'=>'2',
            'nombre' => 'Sandok usuario',
            'cedula' => '11556699',
            'nit'=> '0',
            'telefono'=> '3213145588',
            'direccion'=>'CL 5b KR 8',
            'tipo'=>'1',
            'nombre' => 'PEDRO2',
            'cedula' => '222222',
            'nit'=> '222222',
            'telefono'=> '222222',
            'direccion'=>'222222',
            'tipo'=>'3',
            'estado'=>'A',
            'user_id'=>'2',
            'empresa_id'=>'1',
            'created_at'=>$current_date_time,
            'updated_at'=> $current_date_time
        ]);

        App\Usuario::create([
            'id'=>'3',
            'nombre' => 'PEDRO3',
            'cedula' => '334536',
            'nit'=> '2222222',
            'telefono'=> '22222222',
            'direccion'=>'1',
            'tipo'=>'3',
            'estado'=>'A',
            'user_id'=>'1',
            'empresa_id'=>'1',
            'created_at'=>$current_date_time,
            'updated_at'=> $current_date_time
        ]);

        App\Usuario::create([
            'id'=>'4',
            'nombre' => 'PEDRO4',
            'cedula' => '334536',
            'nit'=> '2222222',
            'telefono'=> '22222222',
            'direccion'=>'1',
            'tipo'=>'3',
            'estado'=>'A',
            'user_id'=>'1',
            'empresa_id'=>'1',
            'created_at'=> $current_date_time,
            'updated_at'=> $current_date_time
        ]);

        App\Usuario::create([
            'id'=>'5',
            'nombre' => 'PEDRO5',
            'cedula' => '334536',
            'nit'=> '2222222',
            'telefono'=> '22222222',
            'direccion'=>'1',
            'tipo'=>'3',
            'estado'=>'A',
            'user_id'=>'1',
            'empresa_id'=>'2',
            'created_at'=>$current_date_time,
            'updated_at'=> $current_date_time
        ]);
        App\Usuario::create([
            'id'=>'6',
            'nombre' => 'PEDRO6',
            'cedula' => '334536',
            'nit'=> '2222222',
            'telefono'=> '22222222',
            'direccion'=>'1',
            'tipo'=>'3',
            'estado'=>'A',
            'user_id'=>'1',
            'empresa_id'=>'2',
            'created_at'=>$current_date_time,
            'updated_at'=> $current_date_time
        ]);
        App\Usuario::create([
            'id'=>'7',
            'nombre' => 'PEDRO7',
            'cedula' => '334536',
            'nit'=> '2222222',
            'telefono'=> '22222222',
            'direccion'=>'1',
            'tipo'=>'3',
            'estado'=>'A',
            'user_id'=>'1',
            'empresa_id'=>'2',
            'created_at'=>$current_date_time,
            'updated_at'=> $current_date_time
        ]);
        App\Usuario::create([
            'id'=>'8',
            'nombre' => 'PEDRO8',
            'cedula' => '334536',
            'nit'=> '2222222',
            'telefono'=> '22222222',
            'direccion'=>'1',
            'tipo'=>'3',
            'estado'=>'A',
            'user_id'=>'1',
            'empresa_id'=>'2',
            'created_at'=>$current_date_time,
            'updated_at'=> $current_date_time
        ]);
        

        App\Usuario::create([
            'id'=>'16',
            'nombre' => 'Edwin Sandoval',
            'cedula' => '334536',
            'nit'=> '0',
            'telefono'=> '3213145208',
            'direccion'=>'CL 22 KR 15',
            'tipo'=>'1',
            'estado'=>'A',
            'user_id'=>'16',
            'empresa_id'=>'1',

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
    }
}
