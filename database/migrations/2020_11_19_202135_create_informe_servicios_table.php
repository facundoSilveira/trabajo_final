<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInformeServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informe_servicios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->double('presupuesto');
            $table->date('fechaInicio');
            $table->date('fechaFin');
            $table->string('problemaTecnico')->nullable();
            $table->string('descripcion')->nullable();
            $table->boolean('confirmacion')->nullable();
            $table->softDeletes();
            $table->unsignedBigInteger('servicio_id');
            $table->foreign('servicio_id')->references('id')->on('servicios');
            $table->unsignedBigInteger('tecnico_id');
            $table->foreign('tecnico_id')->references('id')->on('tecnicos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('informe_servicios');
    }
}
