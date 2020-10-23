<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ClienteSeeder extends Seeder

{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $current_date_time = (Carbon::now()->subDays(1))->toDateTimeString(); // Produces something like "2019-03-11 12:25:00"
        //

        $cont_id = 1;
        //Cantidad carteras
        for($i = 1; $i <= 8; $i++){
            //Cantidad Clientes
            for($j = 1; $j <= 100; $j++){
                App\Cliente::create([
                    'id'=>$cont_id,
                    'nombre'=>'Cliente '.$cont_id,
                    'direccion'=>'Direccion cliente '.$cont_id,
                    'telefono'=>'321314'.$cont_id,
                    'cedula'=>'112233'.$cont_id,
                    'cartera_id'=>$i,
                    'fecha_ultima_visita'=>$current_date_time,
                    'posicion' => $j,
                    'deuda' => $i*$j*1000,
                    'intentos_sin_ventas' => 0,
                    'estado' => 'A',
                    'created_at'=> $current_date_time,
                    'updated_at'=> $current_date_time
                ]);
                $cont_id = $cont_id + 1;
            }
        }
        

    

        
    }
}
