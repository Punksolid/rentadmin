<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatContratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_contratos', function (Blueprint $table) {
            $table->increments('id_contratos');
            $table->integer('id_arrendador')->unsigned()->nullable();
            $table->integer('id_arrendatario')->unsigned()->nullable();
            $table->integer('id_finca')->unsigned()->nullable();
            $table->string('duracion_contrato');
            $table->string('bonificacion');
            $table->string('deposito');
            $table->boolean('estatus')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_arrendador')
                ->references('id_cat_arrendador')
                ->on('cat_arrendador');
            $table->foreign('id_arrendatario')
                ->references('id_cat_arrendatario')
                ->on('cat_arrendatario');
            $table->foreign('id_finca')
                ->references('id_cat_fincas')
                ->on('cat_fincas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cat_contratos');
    }
}
