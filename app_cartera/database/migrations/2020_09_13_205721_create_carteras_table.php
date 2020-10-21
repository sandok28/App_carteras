<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarterasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carteras', function (Blueprint $table) {
            $table->id();
            $table->string("nombre");
            $table->string("descripcion");
            $table->string("estado");
            $table->integer('empresa_id');
            $table->integer('usuario_id');
            $table->integer('tipo');
            $table->string("cargue")->default('D');
            $table->integer('credito_del_dia')->default('0');
            $table->integer('saldo_del_dia')->default('0');
            $table->integer('abono_del_dia')->default('0');
            $table->integer('venta_del_dia')->default('0');
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
        Schema::dropIfExists('carteras');
    }
}
