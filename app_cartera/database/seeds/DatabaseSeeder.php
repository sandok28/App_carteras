<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
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
         $this->call(UsuariosSeeder::class);
         $this->call(CarterasSeeder::class);
         $this->call(ProductosSeeder::class);
         $this->call(NovedadesSeeder::class);
         $this->call(BonosSeeder::class);
         $this->call(ClienteSeeder::class);
         $this->call(ListaNegraClientesSeeder::class);
         $this->call(NeverasSeeder::class);
         $this->call(DiasSeeder::class);

         
    }
}
