<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatIncidentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_incidentes', function (Blueprint $table) {
            $table->increments('id_cat_incidentes');
            $table->integer('id_finca')->unsigned();
            $table->integer('id_usuario_inicio')->unsigned();
            $table->integer('id_usuario_fin')->unsigned();
            $table->date('fecha_reporte');
            $table->string('reporto');
            $table->string('incidente');
            $table->string('area');
            $table->string('asignado');
            $table->string('tel_asignado');
            $table->date('fecha_asignacion');
            $table->time('hora');
            $table->string('solucion')->nullable();
            $table->date('fecha_termino')->nullable();
            $table->boolean('estatus_proceso')->default(false);
            $table->string('observaciones')->nullable();
            $table->boolean('estatus')->default(true);
            $table->timestamps();
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
        Schema::dropIfExists('cat_incidentes');
    }
}
