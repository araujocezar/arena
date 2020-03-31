<?php

namespace App\Http\Controllers;

use App\Aluno;
use Illuminate\Http\Request;

class AlunoController extends Controller
{
    public function listarAlunos(){
        try{
            return view('aluno.listagem-alunos', ['alunos'=> Aluno::all()]);
        }catch (\Exception $e){
            return 'dale';
        }
    }
}
