<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixCatArrendadorTableToLassor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('cat_arrendador', 'lessors');
        Schema::table('lessors', function (Blueprint $table) {
            $table->renameColumn('id_cat_arrendador', 'id');
            $table->renameColumn('id_usuario', 'user_id');
            $table->dropForeign('cat_arrendador_id_usuario_foreign');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('lessors', 'cat_arrendador');
        Schema::table('cat_arrendador', function (Blueprint $table) {
            $table->renameColumn('id', 'id_cat_arrendador');
            $table->renameColumn('user_id', 'usuario_id');
        });
    }
}
