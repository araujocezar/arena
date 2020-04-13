<?php

namespace App\Http\Controllers;

use App\Aluno;
use Illuminate\Http\Request;

class AlunoController extends Controller
{
    public function listarAlunos($parametros)
    {
        try {
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
            return view('aluno.listagem-alunos', ['alunos' => $lista]);
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function filtrar_aluno_cpf(Request $request)
    {
        try {
            $busca = trim($request->busca);
            if ($busca === null || $busca === '') {
                $lista = Aluno::all();
                return view('aluno.listagem-alunos', ['alunos' => $lista]);
            }
            $busca = $this->verificaCpf($request->busca);
            if ($busca) { //após a verificação, valida se é um CPF, se for entra nesse primeiro if, caso contrario ele busca por nome
                $cpf = $this->limpaCPF_CNPJ($request->busca);
                $aluno = Aluno::where('cpf', '=', $cpf)->get();
                return view('aluno.listagem-alunos', ['alunos' => $aluno]);
            } else {
                $aluno = Aluno::where('nome', 'like',  '%' . $request->busca . '%')->get();
                return view('aluno.listagem-alunos', ['alunos' => $aluno]);
            }
        } catch (\Exception $e) {
            return 'dale2';
        }
    }

    function verificaCpf($cpf)
    {

        $cpf = preg_replace('/[^0-9]/is', '', $cpf);
        if (strlen($cpf) != 11) {
            return false;
        }
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf{
                    $c} * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf{
                $c} != $d) {
                return false;
            }
        }
        return true;
    }

    function limpaCPF_CNPJ($valor)
    {
        $valor = preg_replace('/[^0-9]/', '', $valor);
        return $valor;
    }

    function delete($id)
    {
        try {
            $aluno = Aluno::find($id);
            $aluno->delete();
            return back()->withStatus(__('Aluno deletado com sucesso!'));
        } catch (\Exception $e) {
            return 'dale2';
        }
    }
}
