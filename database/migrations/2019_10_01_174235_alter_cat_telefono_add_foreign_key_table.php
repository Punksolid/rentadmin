<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCatTelefonoAddForeignKeyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cat_telefono', function (Blueprint $table) {
            $table->foreign('id_arrendador')
                ->references('id_cat_arrendador')
                ->on('cat_arrendador');
            $table->foreign('id_arrendatario')
                ->references('id_cat_arrendatario')
                ->on('cat_arrendatario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cat_telefono', function (Blueprint $table) {
            $table->dropForeign(['id_arrendador']);
            $table->dropForeign(['id_arrendatario']);
        });
    }
}
