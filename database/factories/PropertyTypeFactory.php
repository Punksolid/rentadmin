<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\TipoPropiedad::class, function (Faker $faker) {
    return [
        'tipo_propiedad' => $faker->word,
        'estatus' => $faker->boolean
    ];
});
