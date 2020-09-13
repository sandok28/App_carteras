<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class EmpresasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $current_date_time = Carbon::now()->toDateTimeString(); // Produces something like "2019-03-11 12:25:00"
        
        App\Empresa::create([
            'id'=>'1',
            'nombre' => 'Distri Quesos',
            'descripcion' => 'Se venden quesos',
            'created_at'=> $current_date_time,
            'updated_at'=> $current_date_time
        ]);

        App\Empresa::create([
            'id'=>'2',
            'nombre' => 'Distri Yogurt',
            'descripcion' => 'Se venden yogurt',
            'created_at'=> $current_date_time,
            'updated_at'=> $current_date_time
        ]);

    }
}
