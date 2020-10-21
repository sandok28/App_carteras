<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class NeverasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $current_date_time = Carbon::now()->toDateTimeString(); // Produces something like "2019-03-11 12:25:00"

        $cont_id = 1;
        //Cantidad carteras
        for($i = 1; $i <= 4; $i++){
            //Cantidad productos
            for($j = 1; $j <= 5; $j++){
                App\Nevera::create([
                    'id'=>$cont_id,
                    'producto_id'=>$j,
                    'cantidad'=>$cont_id + $j,
                    'cartera_id'=>$i,                    
                    'created_at'=> $current_date_time,
                    'updated_at'=> $current_date_time
                ]);
                $cont_id = $cont_id + 1;
            }
        }    
    }
}
