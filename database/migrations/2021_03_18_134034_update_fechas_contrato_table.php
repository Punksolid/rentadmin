<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFechasContratoTable extends Migration
{
    public function up()
    {
        Schema::table('fechas_contrato', function (Blueprint $table) {
            $table->renameColumn('id_fechas_contrato','id');
            $table->renameColumn('id_contrato','contract_id');
            $table->json('bulk')->nullable();
        });
    }

    public function down()
    {
        Schema::table('fechas_contrato', function (Blueprint $table) {
            $table->renameColumn('id','id_fechas_contrato');
            $table->renameColumn('contract_id','id_contrato');
            $table->removeColumn('bulk');
        });
    }
}
