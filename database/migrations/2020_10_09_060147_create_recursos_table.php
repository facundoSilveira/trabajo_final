<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recursos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->softDeletes();
            $table->integer('stock')->nullable();
            $table->integer('stockMinimo');
            $table->string('nroSerie');
            $table->string('tamaño');
            $table->float('precio')->nullable();
            $table->unsignedBigInteger('medida_id');
            $table->foreign('medida_id')->references('id')->on('medidas');
            $table->unsignedBigInteger('marca_recurso_id');
            $table->foreign('marca_recurso_id')->references('id')->on('marca_recursos');
            $table->unsignedBigInteger('tipo_recurso_id');
            $table->foreign('tipo_recurso_id')->references('id')->on('tipo_recursos');
            $table->unsignedBigInteger('modelo_id');
            $table->foreign('modelo_id')->references('id')->on('modelos');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recursos');
    }
}
