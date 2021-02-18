<?php

/** @var Factory $factory */

use App\Model;
use App\Models\CatBanco;
use App\Models\Lessor;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(CatBanco::class, function (Faker $faker) {
    return [
        'id_arrendador' => factory(Lessor::class)->create()->id,
        'banco' => $faker->word,
        'cuenta' => $faker->bankAccountNumber,
        'clabe' => $faker->numerify('################'),
        'estatus' => $faker->boolean,
        'nombre_titular' => $faker->name. ' '. $faker->lastName
    ];
});
