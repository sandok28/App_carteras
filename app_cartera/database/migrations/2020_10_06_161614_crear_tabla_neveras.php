<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaNeveras extends Migration
{
    public function up()
    {
        Schema::create('neveras', function (Blueprint $table) {
            
            $table->id();
            $table->integer("producto_id");
            $table->integer("cantidad")->default('0');
            $table->integer("cartera_id");
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('neveras');
    }
}
