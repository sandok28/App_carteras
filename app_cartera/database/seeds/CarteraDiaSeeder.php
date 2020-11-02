<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CarteraDiaSeeder extends Seeder
{
    
    public function run()
    {
       
        DB::table('cartera_dia')->insert([
            'id' => '1',
            'cartera_id' => '1',
            'dia_id' => '1'
        ]);

        DB::table('cartera_dia')->insert([
            'id' => '2',
            'cartera_id' => '1',
            'dia_id' => '2'
        ]);

        DB::table('cartera_dia')->insert([
            'id' => '3',
            'cartera_id' => '1',
            'dia_id' => '3'
        ]);

        DB::table('cartera_dia')->insert([
            'id' => '4',
            'cartera_id' => '1',
            'dia_id' => '4'
        ]);

        DB::table('cartera_dia')->insert([
            'id' => '5',
            'cartera_id' => '1',
            'dia_id' => '5'
        ]);

        DB::table('cartera_dia')->insert([
            'id' => '6',
            'cartera_id' => '1',
            'dia_id' => '6'
        ]);

        DB::table('cartera_dia')->insert([
            'id' => '7',
            'cartera_id' => '1',
            'dia_id' => '7'
        ]);
            
 
    
    }
}
