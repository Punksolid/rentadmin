<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\FechaContrato;
use Faker\Generator as Faker;

$factory->define(FechaContrato::class, function (Faker $faker) {
    return [
        'fecha_inicio' => now()->toDateString(),
        'fecha_fin' => now()->addMonth()->toDateString(),
        'cantidad' => random_int(1000,99999)
    ];
});
