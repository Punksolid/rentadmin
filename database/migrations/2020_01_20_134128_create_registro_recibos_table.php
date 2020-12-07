<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistroRecibosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registro_recibos', function (Blueprint $table) {
            $table->increments('id_registro_recibos');
            $table->integer('id_usuario')->unsigned();
            $table->integer('id_contrato')->unsigned();
            $table->string('observaciones')->nullable();
            $table->string('mes');
            $table->string('total');
            $table->boolean('estatus_pago')->default(0);
            $table->date('fecha_pago')->nullable();
            $table->boolean('activo')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_contrato')
                ->references('id_contratos')
                ->on('cat_contratos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registro_recibos');
    }
}
