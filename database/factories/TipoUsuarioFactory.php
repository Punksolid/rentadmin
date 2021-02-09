<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\TipoUsuario::class, function (Faker $faker) {
    return [
        'nombre' => $faker->word
    ];
});
