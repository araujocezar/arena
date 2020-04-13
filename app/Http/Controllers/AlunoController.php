<?php

namespace App\Http\Controllers;

use App\Aluno;
use Illuminate\Http\Request;

class AlunoController extends Controller
{
    public function listarAlunos($parametros){
        try{
            $lista = [];
            if ($parametros == "todos") {
                $lista = Aluno::all();
            } else if ($parametros == "futvolei") {
//                $lista = Aluno::where()-> planos aluno -> categoria == id futvolei ->get()
                $lista = Aluno::all();
                dd($lista);
            } else if ($parametros == "funcional") {
//                $lista = Aluno::where() -> planos aluno -> categoria == id funcional ->get()
                $lista = Aluno::all();
            }
            return view('aluno.listagem-alunos', ['alunos'=> $lista]);
        }catch (\Exception $e){
            dd($e);
            return 'dale';
        }
    }
}
