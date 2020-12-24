<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeFacturacionFieldsToNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lessors', function (Blueprint $table) {
            $table->string('calle_facturacion')->nullable()->change();
            $table->string('numero_ext_facturacion')->nullable()->change();
            $table->string('numero_int_facturacion')->nullable()->change();
            $table->string('colonia_facturacion')->nullable()->change();
            $table->string('entre_calles_facturacion')->nullable()->change();
            $table->string('ciudad_facturacion')->nullable()->change();
            $table->string('estado_facturacion')->nullable()->change();
            $table->string('codigo_postal_facturacion')->nullable()->change();
            $table->string('rfc')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
