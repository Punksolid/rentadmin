<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\CatTelefono::class, function (Faker $faker) {
    return [
        'telefono' => $faker->phoneNumber,
        'descripcion' => $faker->sentence,
        'estatus' => \App\Models\CatTelefono::ACTIVE_STATUS
    ];
});
