<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Plano;
use Faker\Generator as Faker;

$factory->define(Plano::class, function (Faker $faker) {
    return [
        'descricao' => $faker->jobTitle(),
        'dias_semana' => $faker->numberBetween(1, 5),
        'preco' => $faker->numberBetween(80, 120),
        'preco_trimestral' => $faker->numberBetween(80, 120),
        'preco_semestral' => $faker->numberBetween(80, 120),
        'categoria_id' => $faker->numberBetween(1, 2)
    ];
});
