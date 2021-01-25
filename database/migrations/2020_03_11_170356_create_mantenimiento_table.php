<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMantenimientoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mantenimiento', function (Blueprint $table) {
            $table->increments('id_mantenimiento');
            $table->integer('id_finca')->unsigned();
            $table->integer('id_usuario')->unsigned();
            $table->integer('id_tipo_mantenimiento')->unsigned();
            $table->string('descripcion_mantenimiento')->nullable();
            $table->string('ubicacion')->nullable();
            $table->string('encargado')->nullable();
            $table->string('tel_encargado')->nullable();
            $table->date('fecha_registro')->nullable();
            $table->boolean('recurrente')->default(false);
            $table->string('ciclo_recurrente');
            $table->string('plazo_recurrente');
            $table->boolean('estatus_proceso')->default(false);
            $table->string('observaciones')->nullable();
            $table->boolean('estatus')->default(true);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('id_finca')->references('id_cat_fincas')->on('cat_fincas');
            $table->foreign('id_usuario')->references('id_usuarios')->on('usuarios');
            $table->foreign('id_tipo_mantenimiento')->references('id_tipo_mantenimiento')->on('tipo_mantenimiento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mantenimiento');
    }
}
