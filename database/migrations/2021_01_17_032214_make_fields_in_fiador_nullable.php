<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeFieldsInFiadorNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cat_fiadores', function (Blueprint $table) {
            $table->string('entre_calles')->nullable()->change();
            $table->string('calle_trabajo')->nullable()->change();
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
        Schema::table('cat_fiadores', function (Blueprint $table) {
            $table->string('entre_calles')->change();
            $table->string('calle_trabajo')->change();
            $table->string('entre_calles_trabajo')->change();
        });
    }
}
