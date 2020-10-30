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
            $table->increments('id');
            $table->string("nombre");
            $table->string("descripcion");
            $table->string("estado");
            $table->integer('empresa_id')->unsigned();
            $table->integer('usuario_id')->nullable()->unsigned();
            $table->integer('tipo');
            $table->string("cargue")->default('D');
            $table->integer('credito_del_dia')->default('0');
            $table->integer('saldo_del_dia')->default('0');
            $table->integer('abono_del_dia')->default('0');
            $table->integer('venta_del_dia')->default('0');
            $table->integer('cargue_del_dia')->default('0');
            $table->timestamps();

            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('cascade')->onUpdate('cascade');

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
