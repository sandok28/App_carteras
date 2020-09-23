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
            'descripcion' => 'descripcion del id 1',                         
            'mi_fecha' => $current_date_time, 
            'valor' => '100',
            'created_at'=> $current_date_time,
            'updated_at'=> $current_date_time
        ]);    


         App\Bono::create([
            
            'cartera_id' => '2',
            'descripcion' => 'descripcion del id 2',                         
            'mi_fecha' => $current_date_time, 
            'valor' => '33333',
            'created_at'=> $current_date_time,
            'updated_at'=> $current_date_time
        ]);    



         App\Bono::create([
            
            'cartera_id' => '3',
            'descripcion' => 'descripcion del id 3',                         
            'mi_fecha' => $current_date_time, 
            'valor' => '39999999',
            'created_at'=> $current_date_time,
            'updated_at'=> $current_date_time
        ]);    



         App\Bono::create([
            
            'cartera_id' => '4',
            'descripcion' => 'descripcion del id 4',                         
            'mi_fecha' => $current_date_time, 
            'valor' => '99999',
            'created_at'=> $current_date_time,
            'updated_at'=> $current_date_time
        ]);    



         App\Bono::create([
            
            'cartera_id' => '5',
            'descripcion' => 'descripcion del id 5',                         
            'mi_fecha' => $current_date_time, 
            'valor' => '6555666',
            'created_at'=> $current_date_time,
            'updated_at'=> $current_date_time
        ]);    



         App\Bono::create([
            
            'cartera_id' => '6',
            'descripcion' => 'descripcion del id 6',                         
            'mi_fecha' => $current_date_time, 
            'valor' => '9998888',
            'created_at'=> $current_date_time,
            'updated_at'=> $current_date_time
        ]);    
    }
}
