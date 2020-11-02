<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNovedadesTable extends Migration
{
    /**
     * Ejecute las migraciones.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('novedades', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("cartera_id")->unsigned();
            $table->string("novedad");
            $table->string("usuario_nombre");
            $table->date("mi_fecha");
            $table->timestamps();

            $table->foreign('cartera_id')->references('id')->on('carteras')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Revertir las migraciones.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('novedades');
    }
}
