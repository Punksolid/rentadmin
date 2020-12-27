<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeFieldsOfFincaToEnglish extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::rename('cat_fincas', 'properties');
        Schema::table('properties', function (Blueprint $table) {
            $table->dropForeign('cat_fincas_id_arrendador_foreign');
            $table->dropForeign('cat_fincas_id_tipo_propiedad_foreign');
            $table->dropForeign('cat_fincas_id_estados_foreign');
            $table->renameColumn('estatus','status');
            $table->renameColumn('servicio_luz','energy_fee');
            $table->renameColumn('cuota_agua','water_fee');
            $table->renameColumn('finca_arrendada','name');
            $table->renameColumn('id_tipo_propiedad','property_type_id');
            $table->renameColumn('descripcion','address'); // repurposed field
            $table->renameColumn('cta_japac','water_account_number');
            $table->renameColumn('mantenimiento','maintenance');
            $table->renameColumn('estatus_renta','rented');
            $table->renameColumn('id_cat_fincas','id');
            $table->renameColumn('id_arrendador','lessor_id');
            $table->renameColumn('id_estados','state_id');
            $table->string('geolocation')->nullable();
            $table->foreign('lessor_id')->references('id')->on('lessors');
            $table->foreign('property_type_id')->references('id_tipo_propiedad')->on('tipo_propiedad');
            $table->foreign('state_id')->references('id_estados')->on('sub_cat_estados');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('properties', 'cat_fincas');
        Schema::table('cat_fincas', function (Blueprint $table) {
            $table->dropForeign('properties_lessor_id_foreign');
            $table->dropForeign('properties_property_type_id_foreign');
            $table->dropForeign('properties_id_estados_foreign');

            $table->renameColumn('status','estatus');
            $table->renameColumn('energy_fee','servicio_luz');
            $table->renameColumn('water_fee','cuota_agua');
            $table->renameColumn('name','finca_arrendada');
            $table->renameColumn('property_type_id','id_tipo_propiedad');
            $table->renameColumn('address','descripcion'); //reused field
            $table->renameColumn('water_account_number','cta_japac'); //reused field
            $table->renameColumn('rented','estatus_renta');
            $table->renameColumn('id','id_cat_fincas');
            $table->renameColumn('lessor_id','id_arrendador');
            $table->renameColumn('state_id','id_estados');
            $table->renameColumn('maintenance','mantenimiento');
            $table->dropColumn('geolocation');
            $table->foreign('id_arrendador')->references('id')->on('lessors');
            $table->foreign('id_tipo_propiedad')->references('id_tipo_propiedad')->on('tipo_propiedad');
            $table->foreign('id_estados')->references('id_estados')->on('cat_sub_estados');
        });
    }
}
