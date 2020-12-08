<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatFiadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_fiadores', function (Blueprint $table) {
            $table->increments('id_cat_fiadores');
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
            $table->string('calle_trabajo');
            $table->string('colonia_trabajo');
            $table->string('numero_ext_trabajo');
            $table->string('numero_int_trabajo')->nullable();
            $table->string('estado_trabajo');
            $table->string('ciudad_trabajo');
            $table->string('codigo_postal_trabajo');
            $table->string('entre_calles_trabajo');
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
        Schema::dropIfExists('cat_fiadores');
    }
}
