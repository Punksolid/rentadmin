<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TransformCatTelefonoIntoMorphTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('cat_telefono', 'phone_numbers');
        Schema::table('phone_numbers', function (Blueprint $table){
            $table->morphs('phoneable');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::rename('phone_numbers', 'cat_telefono');
        Schema::table('cat_telefono', function (Blueprint $table){
            $table->dropMorphs('phoneable');
        });
    }
}
