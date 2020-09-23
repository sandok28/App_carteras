<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ListaNegraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $current_date_time = Carbon::now()->toDateTimeString(); // Produces something like "2019-03-11 12:25:00"


        App\ListaNegra::create([
            
            'cliente_id' => '1',
            'fecha_ingreso' => $current_date_time,
            'monto_ingreso' => '10000',
            'estado' => 'P' ,          // P de pendiente  7//7//   C de confirmado
            'created_at'=> $current_date_time,
            'updated_at'=> $current_date_time
        ]);




        App\ListaNegra::create([
            
            'cliente_id' => '2',
            'fecha_ingreso' => $current_date_time,
            'monto_ingreso' => '20000',
            'estado' => 'P' ,          // P de pendiente  7//7//   C de confirmado
            'created_at'=> $current_date_time,
            'updated_at'=> $current_date_time
        ]);



        App\ListaNegra::create([
            
            'cliente_id' => '3',
            'fecha_ingreso' => $current_date_time,
            'monto_ingreso' => '30000',
            'estado' => 'P',          // P de pendiente  7//7//   C de confirmado
            'created_at'=> $current_date_time,
            'updated_at'=> $current_date_time
        ]);




        App\ListaNegra::create([
            
            'cliente_id' => '4',
            'fecha_ingreso' => $current_date_time,
            'monto_ingreso' => '40000',
            'estado' => 'P',          // P de pendiente  7//7//   C de confirmado
            'created_at'=> $current_date_time,
            'updated_at'=> $current_date_time
        ]);





        App\ListaNegra::create([
            
            'cliente_id' => '5',
            'fecha_ingreso' => $current_date_time,
            'monto_ingreso' => '50000',
            'estado' => 'P' ,          // P de pendiente  7//7//   C de confirmado
            'created_at'=> $current_date_time,
            'updated_at'=> $current_date_time
        ]);
    }
}
