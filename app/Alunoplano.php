<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alunoplano extends Model
{
    protected $fillable = ['aluno_id', 'plano_id', 'dias_restantes', 'ultima_visita'];

    public function aluno(){
        return $this->belongsTo('App\Aluno');
    }

    public function plano(){
        return $this->belongsTo('App\Plano');
    }
}
