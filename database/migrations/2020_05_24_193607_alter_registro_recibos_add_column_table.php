<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterRegistroRecibosAddColumnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registro_recibos', function (Blueprint $table) {
            $table->string('deposito')->after('total')->nullable();
            $table->string('complemento')->after('deposito')->nullable();
            $table->string('recibo')->after('complemento');
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
            $table->dropColumn('deposito');
            $table->dropColumn('complemento');
            $table->dropColumn('recibo');

        });
    }
}
