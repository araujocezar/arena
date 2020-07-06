<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plano extends Model
{
    use SoftDeletes;
    protected $fillable = ['descricao', 'dias_semana', 'categoria_id', 'preco'];
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
        return Categoria::firstWhere('id', $this->categoria_id);
    }
}
