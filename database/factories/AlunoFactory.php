<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Aluno;
use Faker\Generator as Faker;

$factory->define(Aluno::class, function (Faker $faker) {
    return [
        'cpf'=> $faker->numberBetween(00000000000,99999999999),
        'nome'=>$faker->name,
        'email'=>$faker->email,
        'data_cadastro'=>$faker->date(),
        'data_expiracao'=>$faker->date(),
        'telefone'=>$faker->phoneNumber,
    ];
});
