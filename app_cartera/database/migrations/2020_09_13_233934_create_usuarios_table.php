<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            
            $table->id();
            $table->string("nombre");
            $table->string ("cedula");
            $table->string("nit");
            $table->string("telefono");
            $table->string("direccion");
            $table->integer("tipo");
            $table->string("estado");
            $table->integer("user_id");
            $table->integer("empresa_id");
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
        Schema::dropIfExists('usuarios');
    }
}
