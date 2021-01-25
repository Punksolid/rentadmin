<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCatTelefonoAddForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cat_telefono', function (Blueprint $table) {
            $table->foreign('id_fiador')
                ->references('id_cat_fiadores')
                ->on('cat_fiadores');
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
            $table->dropForeign(['id_fiador']);
        });
    }
}
