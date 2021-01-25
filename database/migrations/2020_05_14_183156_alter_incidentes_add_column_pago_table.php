<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterIncidentesAddColumnPagoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cat_incidentes', function(Blueprint $table){
            $table->string('pago')->nullable()->after('costo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cat_incidentes', function(Blueprint $table){
            $table->dropColumn('pago');
        });
    }
}
