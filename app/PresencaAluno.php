<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PresencaAluno extends Model
{
    protected $fillable = ['plano_id', 'aluno_id'];

    public function plano()
    {
        return Plano::firstWhere('id', $this->plano_id);
    }

    public function aluno()
    {
        return Aluno::firstWhere('id', $this->aluno_id);
    }
}
