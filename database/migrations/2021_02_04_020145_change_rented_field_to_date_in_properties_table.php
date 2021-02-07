<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeRentedFieldToDateInPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn('rented');
        });
        Schema::table('properties', function (Blueprint $table) {
            $table->date('rented')->nullable()->default(null); //@todo Accept Timezones
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn('rented');
            $table->string('rented')->default('Rentada');
        });
        Schema::table('properties', function (Blueprint $table) {
            $table->string('rented')->default('Rentada');
        });
    }
}
