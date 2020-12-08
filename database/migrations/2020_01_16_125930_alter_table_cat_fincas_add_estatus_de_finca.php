<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableCatFincasAddEstatusDeFinca extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cat_fincas', function (Blueprint $table) {
            $table->string('estatus_renta')->after('cuota_agua')->default('Disponible');
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
            $table->dropColumn('estatus_renta');
        });
    }
}
