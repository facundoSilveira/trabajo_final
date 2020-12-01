<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInformeServicioRecursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informe_servicio_recursos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->integer('cantidad');
            $table->boolean('reserva')->nullable();
            $table->unsignedBigInteger('recurso_id');
            $table->foreign('recurso_id')->references('id')->on('recursos');
            $table->unsignedBigInteger('informe_servicio_id');
            $table->foreign('informe_servicio_id')->references('id')->on('informe_servicios');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('informe_servicio_recursos');
    }
}
