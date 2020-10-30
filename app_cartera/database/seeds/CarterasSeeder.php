<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CarterasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $current_date_time = Carbon::now()->toDateTimeString(); // Produces something like "2019-03-11 12:25:00"

        App\Cartera::create([
            'id'=>'1',
            'nombre' => 'Comuna 1',
            'descripcion' => 'Descripcion cartera 1',
            'estado' => 'A', // A de activo
            'empresa_id' => '1',
            'usuario_id' => '15',
            'tipo' => '1',
            'created_at'=> $current_date_time,
            'updated_at'=> $current_date_time
        ]);


        App\Cartera::create([
            'id'=>'2',
            'nombre' => 'Comuna 2',
            'descripcion' => 'Descripcion cartera 2',
            'estado' => 'A', // A de activo
            'empresa_id' => '1',
            'usuario_id' => '15',
            'tipo' => '1',
            'created_at'=> $current_date_time,
            'updated_at'=> $current_date_time
        ]);

        App\Cartera::create([
            'id'=>'3',
            'nombre' => 'Comuna 3',
            'descripcion' => 'Descripcion cartera 3',
            'estado' => 'A', // A de activo
            'empresa_id' => '1',
            'usuario_id' => '15',
            'tipo' => '1',
            'created_at'=> $current_date_time,
            'updated_at'=> $current_date_time
        ]);

        App\Cartera::create([
            'id'=>'4',
            'nombre' => 'Comuna 4',
            'descripcion' => 'Descripcion cartera 4',
            'estado' => 'A', // A de activo
            'empresa_id' => '1',
            'usuario_id' => '15',
            'tipo' => '1',
            'created_at'=> $current_date_time,
            'updated_at'=> $current_date_time
        ]);

        App\Cartera::create([
            'id'=>'5',
            'nombre' => 'Comuna 5',
            'descripcion' => 'Descripcion cartera 5',
            'estado' => 'A', // A de activo
            'empresa_id' => '2',
            'usuario_id' => '15',
            'tipo' => '1',
            'created_at'=> $current_date_time,
            'updated_at'=> $current_date_time
        ]);

        App\Cartera::create([
            'id'=>'6',
            'nombre' => 'Comuna 6',
            'descripcion' => 'Descripcion cartera 6',
            'estado' => 'A', // A de activo
            'empresa_id' => '2',
            'usuario_id' => '15',
            'tipo' => '1',
            'created_at'=> $current_date_time,
            'updated_at'=> $current_date_time
        ]);

        App\Cartera::create([
            'id'=>'7',
            'nombre' => 'lista negra',
            'descripcion' => 'lista negra',
            'estado' => 'A', // A de activo
            'empresa_id' => '1',
            'usuario_id' => '15',
            'tipo' => '2',
            'created_at'=> $current_date_time,
            'updated_at'=> $current_date_time
        ]);

        App\Cartera::create([
            'id'=>'8',
            'nombre' => 'inactivos',
            'descripcion' => 'Descripcion inactivos',
            'estado' => 'A', // A de activo
            'empresa_id' => '1',
            'usuario_id' => '15',
            'tipo' => '3',
            'created_at'=> $current_date_time,
            'updated_at'=> $current_date_time
        ]);

        App\Cartera::create([
            'id'=>'9',
            'nombre' => 'lista negra',
            'descripcion' => 'lista negra',
            'estado' => 'A', // A de activo
            'empresa_id' => '2',
            'usuario_id' => '15',
            'tipo' => '2',
            'created_at'=> $current_date_time,
            'updated_at'=> $current_date_time
        ]);

        App\Cartera::create([
            'id'=>'10',
            'nombre' => 'inactivos',
            'descripcion' => 'Descripcion inactivos',
            'estado' => 'A', // A de activo
            'empresa_id' => '2',
            'usuario_id' => '15',
            'tipo' => '3',
            'created_at'=> $current_date_time,
            'updated_at'=> $current_date_time
        ]);
    }
}
