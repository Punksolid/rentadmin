<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Lessee;
use App\Models\CatFiador;
use Faker\Generator as Faker;

$factory->define(Lessee::class, function (Faker $faker) {
    return [
        'nombre' => $faker->firstName,
        'apellido_paterno' => $faker->lastName,
        'apellido_materno' => $faker->lastName,
        'id_fiador' => factory(CatFiador::class)->create()->id_cat_fiadores,
        'puesto' => $faker->jobTitle,
        'estatus' => $faker->boolean,
        'calle' => $faker->streetName,
        'colonia' => $faker->word,
        'numero_ext' => $faker->randomNumber(5),
        'numero_int' => $faker->randomNumber(5),
        'estado' => $faker->state,
        'ciudad' => $faker->city,
        'codigo_postal' => $faker->postcode,
        'entre_calles' => $faker->streetName,
        'calle_trabajo' => $faker->streetName,
        'colonia_trabajo' => $faker->word,
        'numero_ext_trabajo' => $faker->randomNumber(4),
        'numero_int_trabajo' => $faker->randomNumber(4),
        'estado_trabajo' => $faker->state,
        'ciudad_trabajo' => $faker->city,
        'codigo_postal_trabajo' => $faker->postcode,
        'entre_calles_trabajo' => $faker->streetName
    ];
});
