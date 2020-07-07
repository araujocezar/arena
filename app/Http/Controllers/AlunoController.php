<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use App\Aluno;
use App\Plano;
use App\PresencaAluno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class AlunoController extends Controller
{
    public function inicio()
    {
        return view('aluno.inicio');
    }

    public function buscarAluno(Request $request)
    {
        $aluno = Aluno::firstWhere('cpf', $request->cpfAluno);

        if ($aluno) {
            $planos = $this->pegarPlanos($aluno->id);
            $dados = [
                'aluno' => $aluno,
                'planos' => $planos,
                'presencas' => $this->pegarPresencasAluno($aluno->id, $planos),
            ];
            $response = view('aluno.inicio', $dados);
        } else {
            $response = back()->with('erro', 'Aluno não Encontrado, insira um CPF valido!');
        }

        return $response;
    }

    private function pegarPlanos($idAluno)
    {
        $alunoPlano = DB::select('select * from aluno_plano where aluno_id = ?', [$idAluno]);
        $planos = [];
        foreach ($alunoPlano as $plano) {
            $planos[] = Plano::firstWhere('id', $plano->id);
        }

        return $planos;
    }

    private function pegarPresencasAluno($alunoId, $planos)
    {
        $ultimoDomingo = $this->pegarUltimoDomingo();
        $hoje = new Carbon();
        $presencasPorPlano = $this->pegarPresencasPorPlano($planos, $alunoId, $ultimoDomingo, $hoje);

        return $presencasPorPlano;
    }

    private function pegarPresencasPorPlano($planos, $alunoId, $ultimoDomingo, $hoje)
    {
        $presencasPorPlano = [];
        foreach ($planos as $plano) {
            $presencasPorPlano[$plano->id] = PresencaAluno::whereBetween('created_at', [$ultimoDomingo, $hoje])
                                                          ->where('plano_id', $plano->id)
                                                          ->where('aluno_id', $alunoId)->count();
        }

        return $presencasPorPlano;
    }

    private function pegarUltimoDomingo()
    {
        $ultimoDomingo = new Carbon();

        while ($ultimoDomingo->dayOfWeek != 0) {
            $ultimoDomingo->subDay();
        }

        return $ultimoDomingo;
    }

    public function registrarPresenca(Request $request)
    {
        $dados = $request->all();
        $plano = Plano::firstWhere('id', $dados['plano_id']);
        $presencasAluno = $this->pegarPresencasAluno($dados['aluno_id'], [$plano]);

        if (isset($dados['plano_id'])) {
            if ($presencasAluno[$plano->id] < $plano->dias_semana) {
                PresencaAluno::create($dados);
                $response = redirect()->route('inicio')->with('sucesso', 'Presenca registrada');
            } else {
                $aluno = Aluno::firstWhere('id', $dados['aluno_id']);
                $categoria = $plano->categoria();
                $response = redirect()->route('inicio')->with('erro', "$aluno->nome já atingiu o limite semanal para o plano $categoria->tipo");
            }
        } else {
            $response = back()->with('erro', 'Selecione o Plano!!!');
        }

        return $response;
    }

    public function listarAlunos($parametros)
    {
        try {
            $lista = [];
            if ($parametros == 'todos') {
                $lista = Aluno::all();
            } elseif ($parametros == 'futvolei') {
                $lista = Aluno::whereHas('planos', function (Builder $query) {
                    $query->where('categoria_id', '=', '1');
                })->get();
            } elseif ($parametros == 'funcional') {
                $lista = Aluno::whereHas('planos', function (Builder $query) {
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
        dd($request->all());
        $busca = trim($request->busca);
        if ($busca === null || $busca === '') {
            $aluno = Aluno::all();
        } elseif ($this->verificaCpf($busca)) { //após a verificação, valida se é um CPF, se for entra nesse primeiro if, caso contrario ele busca por nome
            $cpf = $this->limpaCPF_CNPJ($busca);
            if ($tipo != 'todos') { // caso a listagem não seja do tipo todos, filtra baseado na categoria do plano
                $aluno = Aluno::where('cpf', '=', $cpf)->whereHas('planos', function (Builder $query) use ($tipo) {
                    $query->whereHas('categorias', function (Builder $categoria) use ($tipo) {
                        $categoria->where('tipo', 'like', $tipo);
                    });
                })->get();
            } else {
                $aluno = Aluno::where('cpf', '=', $cpf)->get();
            }
        } else {
            if ($tipo != 'todos') { // caso a lisatagem não seja do tipo todos, filtra baseado na categoria do plano
                $aluno = Aluno::where('nome', 'ilike', '%'.$busca.'%')
                    ->whereHas('planos', function (Builder $query) use ($tipo) {
                        $query->whereHas('categorias', function (Builder $categoria) use ($tipo) {
                            $categoria->where('tipo', 'like', $tipo);
                        });
                    })->get();
            } else {
                $aluno = Aluno::where('nome', 'ilike', '%'.$busca.'%')->get();
            }
        }

        return view('aluno.listagem-alunos', ['alunos' => $aluno, 'tipo' => $tipo]);
    }

    public function verificaCpf($cpf)
    {
        $cpf = preg_replace('/[^0-9]/is', '', $cpf);
        if (strlen($cpf) != 11) {
            return false;
        }
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }
        for ($t = 9; $t < 11; ++$t) {
            for ($d = 0, $c = 0; $c < $t; ++$c) {
                $d += $cpf[
                    $c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[
                $c] != $d) {
                return false;
            }
        }

        return true;
    }

    public function limpaCPF_CNPJ($valor)
    {
        $valor = preg_replace('/[^0-9]/', '', $valor);

        return $valor;
    }

    public function destroy($tipo, $id)
    {
        try {
            $aluno = Aluno::find($id);
            $aluno->delete();

            return redirect()->route('listagem-alunos', $tipo)->withStatus(__('Aluno removido com sucesso'));
        } catch (\Exception $e) {
            return redirect()->route('listagem-alunos', $tipo)->withErros(__('Erro ao deletar aluno'));
        }
    }

    public function criar_aluno()
    {
        $planos = Plano::all();
        $planos_futvolei = Plano::where('categoria_id', '=', 1)->get();
        $planos_funcional = Plano::where('categoria_id', '=', 2)->get();

        return view('aluno.cadastro-aluno', ['planos' => $planos, 'funcionais' => $planos_funcional, 'futvolei' => $planos_futvolei]);
    }

    public function save(Request $request)
    {
        $aluno = new Aluno();
        $aluno->fill($request->all());
        $aluno->data_expiracao = now();
        $aluno->data_cadastro = now();
        $aluno->save();

        return redirect()->route('listagem-alunos', 'todos')->withStatus(__('Aluno cadastrado com sucesso.'));
    }
}
