<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFechasContratoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fechas_contrato', function (Blueprint $table) {
            $table->increments('id_fechas_contrato');
            $table->integer('id_contrato')->unsigned()->nullable();
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->string('cantidad');
            $table->boolean('estatus')->default(true);
            $table->softDeletes();
            $table->timestamps();

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
        Schema::dropIfExists('fechas_contrato');
    }
}
