<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Property;
use Faker\Generator as Faker;

$factory->define(Property::class, function (Faker $faker) {
    return [
        'lessor_id' => factory(\App\Models\Lessor::class)->create()->id,
        'property_type_id' => factory(\App\Models\TipoPropiedad::class)->create()->id_tipo_propiedad,
        'state_id' => 1,
        'name' => $faker->words(4, true),
        'energy_fee' => $faker->word,
        'water_account_number' => $faker->word,
        'status' => $faker->boolean,
        'address' => $faker->address,
        'predial' => $faker->numerify('##########'),
        'maintenance' => $faker->numerify('####'),
        'recibo' => $faker->boolean,
        'water_fee' => $faker->numerify('####'),
        'rented' => $faker->date(),
        'geolocation' => $faker->url
    ];
});
