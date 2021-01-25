<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeIndexKeyToCatArrentadariosToLesseeAndId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('cat_arrendatario', function (Blueprint $table) {
            $table->renameColumn('id_cat_arrendatario', 'id');
            $table->rename('lessees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        throw new Exception();
    }
}
