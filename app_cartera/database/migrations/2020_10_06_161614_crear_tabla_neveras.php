<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaNeveras extends Migration
{
    public function up()
    {
        Schema::create('neveras', function (Blueprint $table) {
            
            $table->increments('id');
            $table->integer("producto_id")->unsigned();
            $table->integer("cantidad")->default('0');
            $table->integer("cartera_id")->unsigned();
            $table->timestamps();

            $table->foreign('cartera_id')->references('id')->on('carteras')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade')->onUpdate('cascade');
        });
    }
    public function down()
    {
        Schema::dropIfExists('neveras');
    }
}
