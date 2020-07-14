<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Aluguel;
use Faker\Generator as Faker;

$factory->define(Aluguel::class, function (Faker $faker) {
    return [
        'cpf' => $faker->numberBetween(00000000000, 99999999999),
        'nome' => $faker->name,
        'data' => $faker->date(),
        'tempo' => $faker->numberBetween(1, 2),
        'turno' => $faker->amPm(),
        'valor' =>$faker->randomFloat()
    ];
});
