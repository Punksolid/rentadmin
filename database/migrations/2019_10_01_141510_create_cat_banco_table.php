<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatBancoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_banco', function (Blueprint $table) {
            $table->increments('id_banco');
            $table->integer('id_arrendador')->unsigned();
            $table->string('banco');
            $table->string('cuenta');
            $table->string('clabe');
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
        Schema::dropIfExists('cat_banco');
    }
}
