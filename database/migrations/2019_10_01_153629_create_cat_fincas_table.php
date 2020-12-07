<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatFincasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_fincas', function (Blueprint $table) {
            $table->increments('id_cat_fincas');
            $table->integer('id_arrendador')->unsigned();
            $table->integer('id_tipo_propiedad')->unsigned();
            $table->integer('id_estados')->unsigned();
            $table->string('finca_arrendada');
            $table->string('servicio_luz');
            $table->string('cta_japac');
            $table->string('mantenimiento')->default(0);
            $table->string('recibo');
            $table->string('cuota_agua')->default(0);
            $table->boolean('estatus')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_arrendador')
                ->references('id_cat_arrendador')
                ->on('cat_arrendador');

            $table->foreign('id_tipo_propiedad')
                ->references('id_tipo_propiedad')
                ->on('tipo_propiedad');

            $table->foreign('id_estados')
                ->references('id_estados')
                ->on('sub_cat_estados');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cat_fincas');
    }
}
