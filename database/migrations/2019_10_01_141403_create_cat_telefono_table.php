<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatTelefonoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_telefono', function (Blueprint $table) {
            $table->increments('id_telefono');
            $table->integer('id_arrendador')->unsigned()->nullable();
            $table->integer('id_arrendatario')->unsigned()->nullable();
            $table->integer('id_fiador')->unsigned()->nullable();
            $table->string('telefono');
            $table->string('descripcion');
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
        Schema::dropIfExists('cat_telefono');
    }
}
