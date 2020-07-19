<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Alunoplano;
use Faker\Generator as Faker;

$factory->define(Alunoplano::class, function (Faker $faker) {
    return [
        'aluno_id' => $faker->numberBetween(1, 15),
        'plano_id' => $faker->numberBetween(1, 15),
        'dias_restantes' => $faker->numberBetween(1, 5),
        'ultima_visita' => $faker->date(),
        'data_expiracao' => $faker->date(),
    ];
});