<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorialVentaCarterasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historial_venta_carteras', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cartera_id')->unsigned();
            $table->date("fecha");
            $table->integer('venta')->default('0');
            $table->integer('deuda')->default('0');
            $table->integer('abono')->default('0');
            $table->integer('saldo')->default('0');
            $table->integer('saldo_final')->default('0');
            $table->timestamps();

            $table->foreign('cartera_id')->references('id')->on('carteras')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historial_venta_carteras');
    }
}
