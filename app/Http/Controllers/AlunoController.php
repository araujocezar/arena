<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use App\Aluno;
use Illuminate\Http\Request;
use function foo\func;

class AlunoController extends Controller
{
    public function listarAlunos($parametros)
    {
        try {
            $lista = [];
            if ($parametros == "todos") {
                $lista = Aluno::all();
            } else if ($parametros == "futvolei") {
                $lista = Aluno::whereHas('planos', function(Builder $query){
                    $query->where('categoria_id', '=', '1');
                })->get();
            } else if ($parametros == "funcional") {
                $lista = Aluno::whereHas('planos', function(Builder $query){
                    $query->where('categoria_id', '=', '2');
                })->get();
            }
            return view('aluno.listagem-alunos', ['alunos' => $lista, 'tipo' => $parametros]);
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function filtrar_aluno_cpf($tipo, Request $request)
    {
        $busca = trim($request->busca);
        if ($busca === null || $busca === '') {
            $aluno = Aluno::all();
        } else if ($this->verificaCpf($busca)) { //após a verificação, valida se é um CPF, se for entra nesse primeiro if, caso contrario ele busca por nome
            $cpf = $this->limpaCPF_CNPJ($busca);
            if ($tipo != 'todos'){ // caso a listagem não seja do tipo todos, filtra baseado na categoria do plano
                $aluno = Aluno::where('cpf', '=', $cpf)->whereHas('planos', function (Builder $query) use($tipo){
                    $query->whereHas('categorias', function (Builder $categoria) use($tipo) {
                        $categoria->where('tipo', 'like', $tipo);
                    });
                })->get();
            } else {
                $aluno = Aluno::where('cpf', '=', $cpf)->get();
            }
        } else {
            if ($tipo != 'todos'){ // caso a lisatagem não seja do tipo todos, filtra baseado na categoria do plano
                $aluno = Aluno::where('nome', 'ilike',  '%' . $busca . '%')
                    ->whereHas('planos', function (Builder $query) use($tipo){
                        $query->whereHas('categorias', function (Builder $categoria) use($tipo) {
                            $categoria->where('tipo', 'like', $tipo);
                        });
                })->get();
            } else {
                $aluno = Aluno::where('nome', 'ilike',  '%' . $busca . '%')->get();
            }
        }
        return view('aluno.listagem-alunos', ['alunos' => $aluno, 'tipo' => $tipo]);
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

    public function destroy($tipo, $id)
    {
        try{
            $aluno = Aluno::find($id);
            $aluno->delete();
            return redirect()->route('listagem-alunos', $tipo)->withStatus(__('Aluno removido com sucesso'));
        }catch (\Exception $e){
            return redirect()->route('listagem-alunos', $tipo)->withErros(__('Erro ao deletar aluno'));
        }
    }
}
