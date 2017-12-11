<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('usuario')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('rol',['member','admin'])->default('member');
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('rfc');
            $table->string('telefono');
            $table->string('direccion');
            $table->string('compania');
            $table->string('cp');
            $table->integer('id_ciudad');
            $table->foreign('id_ciudad')->references('id')->on('ciudad');
            //$table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
