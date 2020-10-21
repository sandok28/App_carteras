<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorialVentaClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historial_venta_clientes', function (Blueprint $table) {
            $table->id();
            $table->integer('cliente_id');
            $table->date("fecha");
            $table->integer('venta')->default('0');
            $table->integer('deuda')->default('0');
            $table->integer('abono')->default('0');
            $table->integer('saldo')->default('0');
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
        Schema::dropIfExists('historial_venta_clientes');
    }
}
