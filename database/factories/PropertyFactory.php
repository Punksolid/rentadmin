<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\CatFinca;
use Faker\Generator as Faker;

$factory->define(CatFinca::class, function (Faker $faker) {
    return [
        'id_arrendador' => factory(\App\Models\Lessor::class)->create()->id,
        'id_tipo_propiedad' => factory(\App\Models\TipoPropiedad::class)->create()->id_tipo_propiedad,
        'id_estados' => 1,
        'finca_arrendada' => $faker->words(4, true),
        'servicio_luz' => $faker->word,
        'cta_japac' => $faker->word,
        'estatus' => $faker->boolean,
        'descripcion' => $faker->word,
        'predial' => $faker->word,
        'mantenimiento' => $faker->word,
        'recibo' => $faker->word,
        'cuota_agua' => $faker->word,
        'estatus_renta' => $faker->boolean
    ];
});
