<?php

use App\PresencaAluno;
use Faker\Generator as Faker;

$factory->define(PresencaAluno::class, function (Faker $faker) {
    return [
        'plano_id' => $faker->numberBetween(1, 5),
        'aluno_id' => $faker->numberBetween(1, 5),
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
