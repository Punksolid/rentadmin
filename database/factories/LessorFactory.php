<?php

/** @var Factory $factory */

use App\Models\Lessor;
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Lessor::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class)->create()->id,
        'admon' => $faker->word,
        'nombre' => $faker->name,
        'apellido_paterno' => $faker->lastName,
        'apellido_materno' => $faker->lastName,
        'calle' => $faker->address,
        'colonia' => $faker->word,
        'numero_ext' => $faker->numberBetween(1,1111),
        'estado' => $faker->state,
        'ciudad' => $faker->city,
        'codigo_postal' => $faker->postcode,
        'rfc' => $faker->randomLetter,
        'estatus' => $faker->boolean
    ];
});

$factory->state(Lessor::class,'with_facturacion', function (){
    return [
        'calle_facturacion' => null,
        'colonia_facturacion' => null,
        'numero_ext_facturacion' => null,
        'ciudad_facturacion' => null,
        'numero_int_facturacion' => null,
        'estado_facturacion' => null,
        'codigo_postal_facturacion' => null,
        'entre_calles_facturacion' => null,
    ];
});
