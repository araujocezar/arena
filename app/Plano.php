<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plano extends Model
{
    use SoftDeletes;
    protected $fillable = ['dias_semana', 'preco', 'categoria_id'];

    public function alunos()
    {
        return $this->belongsToMany(Aluno::class);
    }
    public function alunoplanos()
    {
        return $this->hasMany('App\Alunoplano');
    }

    public function categorias()
    {
        return $this->belongsTo('App\Categoria', 'categoria_id');
    }
}
