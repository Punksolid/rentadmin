<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubCatEstadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sub_cat_estados')->insert([
            'estado' => 'Aguascalientes'
        ]);
        DB::table('sub_cat_estados')->insert([
            'estado' => 'Baja California Norte'
        ]);
        DB::table('sub_cat_estados')->insert([
            'estado' => 'Baja California Sur'
        ]);
        DB::table('sub_cat_estados')->insert([
            'estado' => 'Campeche'
        ]);
        DB::table('sub_cat_estados')->insert([
            'estado' => 'Coahuila'
        ]);
        DB::table('sub_cat_estados')->insert([
            'estado' => 'Colima'
        ]);
        DB::table('sub_cat_estados')->insert([
            'estado' => 'Chiapas'
        ]);
        DB::table('sub_cat_estados')->insert([
            'estado' => 'Chihuahua'
        ]);
        DB::table('sub_cat_estados')->insert([
            'estado' => 'Distrito Federal'
        ]);
        DB::table('sub_cat_estados')->insert([
            'estado' => 'Durango'
        ]);
        DB::table('sub_cat_estados')->insert([
            'estado' => 'Guanajuato'
        ]);
        DB::table('sub_cat_estados')->insert([
            'estado' => 'Guerrero'
        ]);
        DB::table('sub_cat_estados')->insert([
            'estado' => 'Hidalgo'
        ]);
        DB::table('sub_cat_estados')->insert([
            'estado' => 'Jalisco'
        ]);
        DB::table('sub_cat_estados')->insert([
            'estado' => 'Estado de México'
        ]);
        DB::table('sub_cat_estados')->insert([
            'estado' => 'Michoacán'
        ]);
        DB::table('sub_cat_estados')->insert([
            'estado' => 'Morelos'
        ]);
        DB::table('sub_cat_estados')->insert([
            'estado' => 'Nayarit'
        ]);
        DB::table('sub_cat_estados')->insert([
            'estado' => 'Nuevo León'
        ]);
        DB::table('sub_cat_estados')->insert([
            'estado' => 'Oaxaca'
        ]);
        DB::table('sub_cat_estados')->insert([
            'estado' => 'Puebla'
        ]);
        DB::table('sub_cat_estados')->insert([
            'estado' => 'Queretaro'
        ]);
        DB::table('sub_cat_estados')->insert([
            'estado' => 'Quintana Roo'
        ]);
        DB::table('sub_cat_estados')->insert([
            'estado' => 'San Luis Potosí'
        ]);
        DB::table('sub_cat_estados')->insert([
            'estado' => 'Sinaloa'
        ]);
        DB::table('sub_cat_estados')->insert([
            'estado' => 'Sonora'
        ]);
        DB::table('sub_cat_estados')->insert([
            'estado' => 'Tabasco'
        ]);
        DB::table('sub_cat_estados')->insert([
            'estado' => 'Tamaulipas'
        ]);
        DB::table('sub_cat_estados')->insert([
            'estado' => 'Tlaxcala'
        ]);
        DB::table('sub_cat_estados')->insert([
            'estado' => 'Veracruz'
        ]);
        DB::table('sub_cat_estados')->insert([
            'estado' => 'Yucatán'
        ]);
        DB::table('sub_cat_estados')->insert([
            'estado' => 'Zacatecas'
        ]);

    }
}
