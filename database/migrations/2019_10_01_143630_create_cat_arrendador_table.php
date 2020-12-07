<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatArrendadorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_arrendador', function (Blueprint $table) {
            $table->increments('id_cat_arrendador');
            $table->integer('id_usuario')->unsigned();
            $table->string('admon');
            $table->string('nombre');
            $table->string('apellido_paterno');
            $table->string('apellido_materno');
            $table->string('calle');
            $table->string('colonia');
            $table->string('numero_ext');
            $table->string('numero_int')->nullable();
            $table->string('estado');
            $table->string('ciudad');
            $table->string('codigo_postal');
            $table->string('entre_calles');
            $table->string('calle_facturacion');
            $table->string('colonia_facturacion');
            $table->string('numero_ext_facturacion');
            $table->string('numero_int_facturacion')->nullable();
            $table->string('estado_facturacion');
            $table->string('ciudad_facturacion');
            $table->string('codigo_postal_facturacion');
            $table->string('entre_calles_facturacion');
            $table->string('rfc');
            $table->boolean('estatus')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_usuario')
                ->references('id_usuarios')
                ->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cat_arrendador');
    }
}
