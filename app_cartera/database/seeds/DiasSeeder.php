<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DiasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()

    {

    $current_date_time = Carbon::now()->toDateTimeString(); // Produces something like "2019-03-11 12:25:00"
        
    
    App\Dia::create([
        'id'=>'1',
        'nombre' => 'Lunes',
        'dia' => '1',
        'created_at'=>$current_date_time,
        'updated_at'=> $current_date_time
    ]);

    App\Dia::create([
        'id'=>'2',
        'nombre' => 'Martes',
        'dia' => '2',
        'created_at'=>$current_date_time,
        'updated_at'=> $current_date_time
    ]);

    App\Dia::create([
        'id'=>'3',
        'nombre' => 'Miercoles',
        'dia' => '3',
        'created_at'=>$current_date_time,
        'updated_at'=> $current_date_time
    ]);

    App\Dia::create([
        'id'=>'4',
        'nombre' => 'Jueves',
        'dia' => '4',
        'created_at'=>$current_date_time,
        'updated_at'=> $current_date_time
    ]);

    App\Dia::create([
        'id'=>'5',
        'nombre' => 'Viernes',
        'dia' => '5',
        'created_at'=>$current_date_time,
        'updated_at'=> $current_date_time
    ]);

    App\Dia::create([
        'id'=>'6',
        'nombre' => 'Sabado',
        'dia' => '6',
        'created_at'=>$current_date_time,
        'updated_at'=> $current_date_time
    ]);

    App\Dia::create([
        'id'=>'7',
        'nombre' => 'Domingo',
        'dia' => '7',
        'created_at'=>$current_date_time,
        'updated_at'=> $current_date_time
    ]);


    }
}
