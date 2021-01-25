<?php

/** @var Factory $factory */

use App\Model;
use App\Models\Contract;
use App\Models\Lessee;
use App\Models\Lessor;
use App\Models\Property;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Contract::class, function (Faker $faker) {
    return [
        'id_arrendador' => factory(Lessor::class)->create()->id,
        'id_arrendatario' => factory(Lessee::class)->create()->id,
        'id_finca' => factory(Property::class)->create()->id,
        'duracion_contrato' => $faker->dateTime,
//        'aumento' => $faker->randomNumber(3),
//        'fecha_inicio',
//        'fecha_fin',
        'bonificacion' => $faker->randomNumber(3),
        'deposito' => $faker->randomNumber(4),
        'estatus' => true
    ];
});
