<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',50);
            $table->string('descripcion',256)->nullable();//Con nullable el campo puede quedar vacio
            $table->boolean('condicion')->default(1); //Por defecto el valor de condicion sera 1 (true)
            $table->timestamps(); //Crea 2 columnas en la tabla create_at y update_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categorias');
    }
}
