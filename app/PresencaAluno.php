<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PresencaAluno extends Model
{
    protected $fillable = ['plano_id', 'aluno_id'];
}
