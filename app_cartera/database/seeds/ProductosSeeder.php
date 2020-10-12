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
            'nombre'=>'queso1',
            'precio'=>'1000',
            'descripcion'=>'queso1',
            'estado'=>'A',
            'cantidad' => '5',
            'empresa_id' => '1',
            'created_at'=> $current_date_time,
            'updated_at'=> $current_date_time
        ]);

        App\Producto::create([
            'id'=>'2',
            'nombre'=>'queso2',
            'precio'=>'1000',
            'descripcion'=>'queso2',
            'estado'=>'A',
            'cantidad' => '5',
            'empresa_id' => '1',
            'created_at'=> $current_date_time,
            'updated_at'=> $current_date_time
        ]);

        App\Producto::create([
            'id'=>'3',
            'nombre'=>'queso3',
            'precio'=>'1000',
            'descripcion'=>'queso3',
            'estado'=>'A',
            'cantidad' => '5',
            'empresa_id' => '1',
            'created_at'=> $current_date_time,
            'updated_at'=> $current_date_time
        ]);

        App\Producto::create([
            'id'=>'4',
            'nombre'=>'queso4',
            'precio'=>'1000',
            'descripcion'=>'queso4',
            'estado'=>'A',
            'cantidad' => '5',
            'empresa_id' => '1',
            'created_at'=> $current_date_time,
            'updated_at'=> $current_date_time
        ]);

        App\Producto::create([
            'id'=>'5',
            'nombre'=>'queso5',
            'precio'=>'1000',
            'descripcion'=>'queso5',
            'estado'=>'A',
            'cantidad' => '5',
            'empresa_id' => '1',
            'created_at'=> $current_date_time,
            'updated_at'=> $current_date_time
        ]);

        App\Producto::create([
            'id'=>'6',
            'nombre'=>'yogurt1',
            'precio'=>'1000',
            'descripcion'=>'yogurt1',
            'estado'=>'A',
            'cantidad' => '5',
            'empresa_id' => '2',
            'created_at'=> $current_date_time,
            'updated_at'=> $current_date_time
        ]);

        App\Producto::create([
            'id'=>'7',
            'nombre'=>'yogurt2',
            'precio'=>'1000',
            'descripcion'=>'yogurt2',
            'estado'=>'A',
            'cantidad' => '5',
            'empresa_id' => '2',
            'created_at'=> $current_date_time,
            'updated_at'=> $current_date_time
        ]);

        App\Producto::create([
            'id'=>'8',
            'nombre'=>'yogurt3',
            'precio'=>'1000',
            'descripcion'=>'yogurt3',
            'estado'=>'A',
            'cantidad' => '5',
            'empresa_id' => '2',
            'created_at'=> $current_date_time,
            'updated_at'=> $current_date_time
        ]);

        App\Producto::create([
            'id'=>'9',
            'nombre'=>'yogurt4',
            'precio'=>'1000',
            'descripcion'=>'yogurt4',
            'estado'=>'A',
            'cantidad' => '5',
            'empresa_id' => '2',
            'created_at'=> $current_date_time,
            'updated_at'=> $current_date_time
        ]);

        App\Producto::create([
            'id'=>'10',
            'nombre'=>'yogurt5',
            'precio'=>'1000',
            'descripcion'=>'yogurt5',
            'estado'=>'A',
            'cantidad' => '5',
            'empresa_id' => '2',
            'created_at'=> $current_date_time,
            'updated_at'=> $current_date_time
        ]);

        
    }
}
