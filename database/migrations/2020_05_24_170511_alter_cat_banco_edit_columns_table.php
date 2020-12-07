<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCatBancoEditColumnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cat_banco', function (Blueprint $table) {
            $table->string('banco')->nullable()->change();
            $table->string('cuenta')->nullable()->change();
            $table->string('clabe')->nullable()->change();
            $table->string('nombre_titular')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cat_banco', function (Blueprint $table) {
            $table->string('nombre_titular')->nullable(false)->change();
            $table->string('banco')->nullable(false)->change();
            $table->string('cuenta')->nullable(false)->change();
            $table->string('clabe')->nullable(false)->change();
        });
    }
}
