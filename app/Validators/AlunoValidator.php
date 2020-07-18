<?php

namespace App\Validators;

use PhpSpec\Laravel\LaravelObjectBehavior;
use App\Aluno;



class AlunoValidator
{

    public static function validate($dados)
    {
        $validator = \Validator::make($dados, 
        [
          'email' => 'unique:alunos,email,'.$dados['id'],
          'cpf' => 'required|min:14|max:14|unique:alunos,cpf,'.$dados['id'],
          'nome' => 'required',
        ]
        , Aluno::$messages);

        if (!$validator->errors()->isEmpty()) {
            throw new ValidationException($validator, $validator->errors());
        }
    }
}


