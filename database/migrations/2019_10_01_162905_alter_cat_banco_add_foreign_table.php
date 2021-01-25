<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCatBancoAddForeignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cat_banco', function (Blueprint $table) {
            $table->foreign('id_arrendador')
                ->references('id_cat_arrendador')
                ->on('cat_arrendador');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cat_banco', function (Blueprint $table) {
            $table->dropForeign(['id_arrendador']);
        });
    }
}
