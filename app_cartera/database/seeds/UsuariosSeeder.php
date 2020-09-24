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
        'name' => 'edwinsandoval.428',
        'email' => 'edwinsandoval.428@gmail.com',
        'password'=> '$2y$10$puZuA/o9UC9z4/r9OaQUa.Jvkakj/SyuymMD7HyvZMeMzmzebfjNW',
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
