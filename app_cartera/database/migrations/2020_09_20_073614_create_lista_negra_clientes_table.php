<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListaNegraClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listanegraclientes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("cliente_id")->unsigned();
            $table->date ("fecha_ingreso");
            $table->integer("monto_ingreso");
            $table->string("estado");
            $table->timestamps();

            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('listanegraclientes');
    }
}
