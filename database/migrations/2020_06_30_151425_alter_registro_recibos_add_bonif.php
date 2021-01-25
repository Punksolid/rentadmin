<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterRegistroRecibosAddBonif extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registro_recibos', function (Blueprint $table) {
            $table->string('bonificacion')->after('total')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('registro_recibos', function (Blueprint $table) {
            $table->dropColumn('bonificacion');
        });
    }
}
