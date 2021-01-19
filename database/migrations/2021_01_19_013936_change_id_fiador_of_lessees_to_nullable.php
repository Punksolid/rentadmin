<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeIdFiadorOfLesseesToNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('lessees', function (Blueprint $table) {
            $table->dropForeign('cat_arrendatario_id_fiador_foreign');
            $table->integer('id_fiador')->unsigned()->nullable()->change();
        });
        Schema::enableForeignKeyConstraints();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lessees', function (Blueprint $table) {
            $table->integer('id_fiador')->change();
        });
    }
}
