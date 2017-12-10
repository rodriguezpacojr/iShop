<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleordenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalleorden', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_orden');
            $table->integer('id_cliente');
            $table->integer('id_producto');
            $table->integer('cantidad');
            $table->primary(['id','id_orden', 'id_cliente','id_producto']);
            $table->foreign('id_orden')->references('id')->on('orden');
            $table->foreign('id_cliente')->references('id')->on('users');
            $table->foreign('id_producto')->references('id')->on('producto');
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
        Schema::dropIfExists('detalleorden');
    }
}
