<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**composer dump-autoload
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(EmpresasTableSeeder::class);
         $this->call(CarterasSeeder::class);
         $this->call(Usuarioseeder::class);
         $this->call(ProductosSeeder::class);
         

         
    }
}
