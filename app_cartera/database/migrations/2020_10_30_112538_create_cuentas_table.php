<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuentas', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('cartera_id')->unsigned();
            $table->date("fecha");
            $table->integer('cargue')->default('0');
            $table->integer('abono')->default('0');
            $table->integer('bono')->default('0');
            $table->integer('almuerzo')->default('0');
            $table->integer('gasto')->default('0');
            $table->integer('descargue')->default('0');
            $table->integer('total')->default('0');
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
        Schema::dropIfExists('cuentas');
    }
}
