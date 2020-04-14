<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    protected $fillable = ['cpf', 'nome', 'email', 'sexo', 'telefone', 'data_cadastro'];

//    public static $rules = [
//        'cpf' => 'unique:clientes|min:11|max:11',
//
//    ];
//
//    public static $messages = [
//        'unique' => 'o campo: attribute deve ser único',
//        'required'=> 'o campo: attribute é obrigatorio',
//        'min' => 'CPF deve conter 11 digítos',
//        'max' => 'CPF deve conter 11 digítos',
//    ];
    public function planos(){
        return $this->belongsToMany('App\Plano');
    }
}
