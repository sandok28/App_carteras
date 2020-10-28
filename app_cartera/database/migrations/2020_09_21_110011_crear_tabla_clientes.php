<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaClientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('clientes', function (Blueprint $table) {
            
            $table->id();
            $table->string ("nombre");
            $table->string ("direccion");
            $table->string ("telefono");
            $table->string ("cedula");
            $table->string('comentarios')->nullable();
            $table->string ("estado");
            $table->integer ("cartera_id");
            $table->date("fecha_ultima_visita");
            $table->integer ("posicion");
            $table->integer("deuda");
            $table->integer ("intentos_sin_ventas");
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
        Schema::dropIfExists('clientes');
    }
}
