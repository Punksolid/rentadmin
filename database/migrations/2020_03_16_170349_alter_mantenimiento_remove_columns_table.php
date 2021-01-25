<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterMantenimientoRemoveColumnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mantenimiento', function(Blueprint $table){
            $table->dropColumn('ciclo_recurrente');
            $table->dropColumn('plazo_recurrente');
            $table->date('prox_mantenimiento')->after('recurrente')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mantenimiento', function(Blueprint $table){
            $table->string('ciclo_recurrente');
            $table->string('plazo_recurrente');
            $table->dropColumn('prox_mantenimiento');
        });
    }
}
