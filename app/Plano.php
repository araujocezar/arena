<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plano extends Model
{
    use SoftDeletes;
    protected $fillable = ['descricao', 'dias_semana', 'categoria_id', 'preco', 'preco_trimestral', 'preco_semestral'];
    public static $rules = [
        'descricao' => 'required',
        'preco' => 'required',
    ];

    public static $messages = [
        'required' => 'o campo: attribute é obrigatorio',
    ];

    public function alunos()
    {
        return $this->belongsToMany(Aluno::class);
    }

    public function alunoplanos()
    {
        return $this->hasMany('App\Alunoplano');
    }

    public function categoria()
    {
        return $this->hasOne('App\Categoria', 'id', 'categoria_id');
    }
}
