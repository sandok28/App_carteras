<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class NovedadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $current_date_time = Carbon::now()->toDateTimeString(); // Produces something like "2019-03-11 12:25:00"

        App\Novedad::create([
            
            'cartera_id' => '1',
            'novedad' => 'novedad del id 1',
            'usuario_nombre' => ' nombre',                         
            'mi_fecha' => $current_date_time, 
            'created_at'=> $current_date_time,
            'updated_at'=> $current_date_time
        ]);    
        App\Novedad::create([
            
            'cartera_id' => '2',
            'novedad' => 'novedad del id 2',
            'usuario_nombre' => ' nombre',                         
            'mi_fecha' => '2020-09-19',
            'created_at'=> $current_date_time,
            'updated_at'=> $current_date_time
        ]); 
        App\Novedad::create([
            
            'cartera_id' => '3',
            'novedad' => 'novedad del id 3',
            'usuario_nombre' => ' nombre',                         
            'mi_fecha' => '2020-09-19',
            'created_at'=> $current_date_time,
            'updated_at'=> $current_date_time
        ]); 
         App\Novedad::create([
            
            'cartera_id' => '4',
            'novedad' => 'novedad del id 4',
            'usuario_nombre' => ' nombre',                         
            'mi_fecha' => '2020-09-19',
            'created_at'=> $current_date_time,
            'updated_at'=> $current_date_time
        ]); 

    }
}
