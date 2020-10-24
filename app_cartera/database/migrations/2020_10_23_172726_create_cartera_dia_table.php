<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarteraDiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cartera_dia', function (Blueprint $table) {
            
            $table->increments('id');
            $table->integer('cartera_id')->unsigned();
            $table->integer('dia_id')->unsigned();
            

            $table->foreign('cartera_id')->references('id')->on('carteras')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('dia_id')->references('id')->on('dias')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cartera_dia');
    }
}
