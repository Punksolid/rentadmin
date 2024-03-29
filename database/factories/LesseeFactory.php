<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Lessee;
use App\Models\Guarantor;
use Faker\Generator as Faker;

$factory->define(Lessee::class, function (Faker $faker) {
    return [
        'id_fiador' => factory(Guarantor::class)->create()->id,
        'nombre' => $faker->firstName,
        'apellido_paterno' => $faker->lastName,
        'apellido_materno' => $faker->lastName,
        'puesto' => $faker->word,
        'estatus' => $faker->boolean,
        'calle' => $faker->streetName,
        'colonia' => $faker->word,
        'numero_ext' => $faker->numerify('####'),
        'estado' => $faker->state,
        'ciudad' => $faker->city,
        'codigo_postal' => $faker->numerify('#####'),
        'colonia_trabajo' => $faker->word,
        'numero_ext_trabajo' => $faker->randomNumber(4),
        'estado_trabajo' => $faker->state,
        'ciudad_trabajo' => $faker->city,
        'calle_trabajo' => $faker->streetAddress,
        'codigo_postal_trabajo' =>$faker->randomNumber(5),
    ];
});
