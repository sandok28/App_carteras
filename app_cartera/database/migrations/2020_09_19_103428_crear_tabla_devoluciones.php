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
            
            $table->increments('id');
            $table->integer ("empresa_id")->unsigned();
            $table->integer ("cartera_id")->unsigned();
            $table->integer ("cliente_id")->unsigned();
            $table->date("fecha");
            $table->integer ("producto_id")->unsigned();
            $table->integer("producto_cantidad");
            $table->timestamps();

            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('cartera_id')->references('id')->on('carteras')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade')->onUpdate('cascade');
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
