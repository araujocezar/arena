<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plano extends Model
{
    protected $fillable = ['dias_semana', 'preco', 'categoria_id'];

    public function alunos(){
        return $this->belongsToMany(Aluno::class);
    }

    public function categoria(){
        return $this->hasOne('App\Categoria');
    }
}
