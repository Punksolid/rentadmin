<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTableNameToCatFiadores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('cat_fiadores', 'guarantors');
        Schema::table('guarantors', function (Blueprint $table) {
            $table->renameColumn('id_cat_fiadores', 'id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('guarantors', 'cat_fiadores');
        Schema::table('cat_fiadores', function (Blueprint $table) {
            $table->renameColumn('id', 'id_cat_fiadores');
        });
    }
}
