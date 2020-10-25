<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaDevoluciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('devoluciones', function (Blueprint $table) {
            
            $table->id("id");
            $table->integer ("empresa_id");
            $table->integer ("cartera_id");
            $table->integer ("cliente_id");
            $table->date("fecha");
            $table->integer ("producto_id");
            $table->integer("producto_cantidad");
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('devoluciones');
    }
}
