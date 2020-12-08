<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatFechasModTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_fechas_mod', function (Blueprint $table) {
            $table->increments('id_fechas');
            $table->integer('id_usuario')->unsigned();
            $table->dateTime('fecha_modificacion');
            $table->string('tabla_modidificada');
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
        Schema::dropIfExists('cat_fechas_mod');
    }
}
