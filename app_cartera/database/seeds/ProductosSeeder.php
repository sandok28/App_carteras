<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ProductosSeeder extends Seeder

{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $current_date_time = Carbon::now()->toDateTimeString(); // Produces something like "2019-03-11 12:25:00"
        //
        App\Producto::create([
            'id'=>'1',
            'nombre'=>'yogurt1',
            'precio'=>'1000',
            'descripcion'=>'yogurt de mora',
            'estado'=>'A',
            'cantidad' => '5',
            'empresa_id' => '1',
            'created_at'=> $current_date_time,
            'updated_at'=> $current_date_time
        ]);

        App\Producto::create([
            'id'=>'2',
            'nombre'=>'yogurt2',
            'precio'=>'1000',
            'descripcion'=>'yogurt de mora',
            'estado'=>'A',
            'cantidad' => '5',
            'empresa_id' => '2',
            'created_at'=> $current_date_time,
            'updated_at'=> $current_date_time
        ]);

        App\Producto::create([
            'id'=>'3',
            'nombre'=>'yogurt3',
            'precio'=>'1000',
            'descripcion'=>'yogurt de mora',
            'estado'=>'A',
            'cantidad' => '5',
            'empresa_id' => '1',
            'created_at'=> $current_date_time,
            'updated_at'=> $current_date_time
        ]);

        App\Producto::create([
            'id'=>'4',
            'nombre'=>'yogurt',
            'precio'=>'1000',
            'descripcion'=>'yogurt de mora',
            'estado'=>'A',
            'cantidad' => '5',
            'empresa_id' => '2',
            'created_at'=> $current_date_time,
            'updated_at'=> $current_date_time
        ]);

        App\Producto::create([
            'id'=>'5',
            'nombre'=>'yogurt5',
            'precio'=>'1000',
            'descripcion'=>'yogurt de mora',
            'estado'=>'A',
            'cantidad' => '5',
            'empresa_id' => '1',
            'created_at'=> $current_date_time,
            'updated_at'=> $current_date_time
        ]);

        
    }
}
