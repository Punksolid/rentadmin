<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCatArrendatariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cat_arrendatario', function (Blueprint $table) {
            $table->string('entre_calles')->nullable()->change();
            $table->string('entre_calles_trabajo')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cat_arrendatario', function (Blueprint $table) {
            $table->string('entre_calles')->nullable(false)->change();
            $table->string('entre_calles_trabajo')->nullable(false)->change();
        });
    }
}
