<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Aluno;
use Faker\Generator as Faker;

$factory->define(Aluno::class, function (Faker $faker) {
    return [
        'cpf'=> $faker->numberBetween(100,999). '.' . $faker->numberBetween(100, 999) . '.' . $faker->numberBetween(100, 999) . '-' . $faker->numberBetween(10, 99),
        'nome'=>$faker->name,
        'email'=>$faker->email,
        'data_cadastro'=>$faker->date(),
        'data_nascimento'=>$faker->date(),
        'data_expiracao'=>$faker->date(),
        'telefone'=>$faker->phoneNumber,
    ];
});
