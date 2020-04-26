<?php

namespace App\Validators;

use PhpSpec\Laravel\LaravelObjectBehavior;
use App\Plano;



class PlanoValidator
{

    public static function validate($dados)
    {
        $validator = \Validator::make($dados, Plano::$rules, Plano::$messages);

        if (!$validator->errors()->isEmpty()) {
            throw new ValidationException($validator, $validator->errors());
        }
    }
}


