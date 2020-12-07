<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfiguracionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configuracion')->insert([
            'nombre' => 'dias_correo',
            'cantidad' => '1'
        ]);
        DB::table('configuracion')->insert([
            'nombre' => 'ret_iva',
            'cantidad' => '10.66'
        ]);
        DB::table('configuracion')->insert([
            'nombre' => 'ret_isr',
            'cantidad' => '10'
        ]);
        DB::table('configuracion')->insert([
            'nombre' => 'comision',
            'cantidad' => '10'
        ]);
        DB::table('configuracion')->insert([
            'nombre' => 'iva',
            'cantidad' => '16'
        ]);
    }
}
