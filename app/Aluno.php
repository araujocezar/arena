<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Aluno extends Model
{
    use SoftDeletes;
    protected $fillable = ['cpf', 'nome', 'email', 'sexo', 'telefone', 'data_cadastro', 'data_nascimento'];
    protected $dates = ['data_cadastro', 'data_nascimento', 'created_at', 'updated_at', 'deleted_at'];

    //  Rules no arquivo de Validator
    // public static $rules = [
    //     'cpf' => 'required|unique:alunos|min:14|max:14',
    //     'nome' => 'required',
    // ];

    public static $messages = [
        'unique' => 'o campo :attribute deve ser único',
        'required'=> 'o campo :attribute é obrigatorio',
        'min' => 'O CPF deve conter 11 digítos',
        'max' => 'O CPF deve conter 11 digítos',
    ];
    public function planos(){
        return $this->belongsToMany('App\Plano');
    }

    public function tempoDoPlano($plano_id)
    {
        $plano = DB::table('aluno_plano')->where('aluno_id', $this->id)->where('plano_id', '=', $plano_id)->first();

        $dataCriado = Carbon::parse($plano->created_at);
        $dataExpiracao = Carbon::parse($plano->data_expiracao);

        return $dataCriado->diffInMonths($dataExpiracao);
    }
}
