<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCatFincasAddColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cat_fincas', function (Blueprint $table) {
            $table->string('descripcion')->after('cta_japac');
            $table->string('predial')->after('descripcion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cat_fincas', function (Blueprint $table) {
            $table->dropColumn('descripcion');
            $table->dropColumn('predial');
        });
    }
}
