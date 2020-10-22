<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class BonosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $current_date_time = Carbon::now()->toDateTimeString(); // Produces something like "2019-03-11 12:25:00"

         App\Bono::create([
            
            'cartera_id' => '1',
            'descripcion' => 'Se le pagan 30 mil para almuerzos y demas',                         
            'mi_fecha' => $current_date_time, 
            'valor' => '30000',
            'created_at'=> $current_date_time,
            'updated_at'=> $current_date_time
        ]);    


         App\Bono::create([
            
            'cartera_id' => '2',
            'descripcion' => 'Se le pagan 30 mil para almuerzos y demas',                         
            'mi_fecha' => $current_date_time, 
            'valor' => '30000',
            'created_at'=> $current_date_time,
            'updated_at'=> $current_date_time
        ]);    



         App\Bono::create([
            
            'cartera_id' => '3',
            'descripcion' => 'Se le pagan 30 mil para almuerzos y demas',                         
            'mi_fecha' => $current_date_time, 
            'valor' => '30000',
            'created_at'=> $current_date_time,
            'updated_at'=> $current_date_time
        ]);    



         App\Bono::create([
            
            'cartera_id' => '4',
            'descripcion' => 'Se le pagan 30 mil para almuerzos y demas',                         
            'mi_fecha' => $current_date_time, 
            'valor' => '30000',
            'created_at'=> $current_date_time,
            'updated_at'=> $current_date_time
        ]);    



         App\Bono::create([
            
            'cartera_id' => '5',
            'descripcion' => 'Se le pagan 30 mil para almuerzos y demas',                         
            'mi_fecha' => $current_date_time, 
            'valor' => '30000',
            'created_at'=> $current_date_time,
            'updated_at'=> $current_date_time
        ]);    



         App\Bono::create([
            
            'cartera_id' => '6',
            'descripcion' => 'Se le pagan 30 mil para almuerzos y demas',                         
            'mi_fecha' => $current_date_time, 
            'valor' => '30000',
            'created_at'=> $current_date_time,
            'updated_at'=> $current_date_time
        ]);    
    }
}
