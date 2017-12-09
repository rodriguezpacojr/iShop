<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductoproveedorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productoproveedor', function (Blueprint $table) {
            $table->integer('id_producto');
            $table->integer('id_proveedor');
            $table->double('precio_compra', 8, 2);
            $table->primary(['id_producto', 'id_proveedor']);
            $table->foreign('id_producto')->references('id')->on('producto');
            $table->foreign('id_proveedor')->references('id')->on('proveedor');
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
        Schema::dropIfExists('productoproveedor');
    }
}
