<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use App\Aluno;
use App\Plano;
use App\PresencaAluno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Database\QueryException;

class AlunoController extends Controller
{
    protected $limite_pagina = 10;

    public function inicio()
    {
        return view('aluno.inicio', ['presencasHoje' => $this->pegarPresencasHoje()]);
    }

    public function buscarAluno(Request $request)
    {
        $aluno = Aluno::firstWhere('cpf', $request->cpfAluno);

        if ($aluno) {
            $planos = $this->pegarPlanos($aluno->id);
            $dados = [
                'aluno' => $aluno,
                'planos' => $planos,
                'datasExpiracao' => $this->pegarDatasExpiracao($aluno->id),
                'presencas' => $this->pegarPresencasAluno($aluno->id, $planos),
                'presencasHoje' => $this->pegarPresencasHoje(),
            ];
            $response = view('aluno.inicio', $dados);
        } else {
            $response = back()->with('erro', 'Aluno não Encontrado, insira um CPF valido!');
        }

        return $response;
    }

    public function pegarPresencasHoje()
    {
        return PresencaAluno::whereYear('created_at', date('Y'))
                            ->whereMonth('created_at', date('m'))
                            ->whereDay('created_at', date('d'))
                            ->get();
    }

    private function pegarPlanos($idAluno)
    {
        $alunoPlano = DB::select('select * from aluno_plano where aluno_id = ?', [$idAluno]);
        $planos = [];
        foreach ($alunoPlano as $plano) {
            $p = Plano::firstWhere('id', $plano->plano_id);
            if(isset($p)){
                $planos[] = $p;
            }
        }

        return $planos;
    }

    private function pegarDatasExpiracao($idAluno)
    {
        $alunoPlano = DB::table('aluno_plano')->where('aluno_id', $idAluno)->get();
        $plunked = $alunoPlano->pluck('data_expiracao', 'plano_id');

        return $plunked;
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

        if (isset($dados['plano_id'])) {
            $plano = Plano::firstWhere('id', $dados['plano_id']);
            $presencasAluno = $this->pegarPresencasAluno($dados['aluno_id'], [$plano]);

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
            $activePage = 'listagem-alunos';
            if ($parametros == 'todos') {
                
                $lista = Aluno::paginate($this->limite_pagina);
            } elseif ($parametros == 'futvolei') {
                $lista = Aluno::whereHas('planos', function (Builder $query) {
                    $query->where('categoria_id', '=', '1');
                })->paginate($this->limite_pagina);
                $activePage = 'listagem-futvolei';
            } elseif ($parametros == 'funcional') {
                $lista = Aluno::whereHas('planos', function (Builder $query) {
                    $query->where('categoria_id', '=', '2');
                })->paginate($this->limite_pagina);
                $activePage = 'listagem-funcional';
            }

            return view('aluno.listagem-alunos', ['alunos' => $lista, 'tipo' => $parametros, 'activePage' => $activePage]);
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function filtrar_aluno_cpf($tipo, Request $request)
    {
        $busca = trim($request->busca);
        
        if ($busca === null || $busca === '') {
            $aluno = Aluno::all();
        } else { //após a verificação, valida se é um CPF, se for entra nesse primeiro if, caso contrario ele busca por nome
            if(is_numeric($busca) && strlen($busca) == 11) {
                $busca = substr($busca, 0, 3) . '.' . substr($busca, 3, 3) . '.' . substr($busca, 6, 3) . '-' . substr($busca, 9, 2);
            }    
            if ($tipo != 'todos') { // caso a listagem não seja do tipo todos, filtra baseado na categoria do plano
                $aluno = Aluno::where('cpf', '=', $busca)
                ->orWhere('nome', 'ilike', '%'.$busca.'%')
                ->whereHas('planos', function (Builder $query) use ($tipo) {
                    $query->whereHas('categoria', function (Builder $categoria) use ($tipo) {
                        $categoria->where('tipo', 'like', $tipo);
                    });
                })->paginate($this->limite_pagina);
         
            } else {
                $aluno = Aluno::where('cpf', '=', $busca)
                ->orWhere('nome', 'ilike', '%'.$busca.'%')
                ->paginate($this->limite_pagina);
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
        $dados = $request->all();
        try{
            if(isset($dados['plano_id_func']) || isset($dados['plano_id_fut'])){
                $aluno = new Aluno();
                $aluno->fill($dados);
                $aluno->data_expiracao = now();
                $aluno->data_cadastro = now();
                $aluno->save();
                
                if(isset($dados['plano_id_func'])){
                    $dadosFunc = [
                        'aluno_id' => $aluno->id,
                        'plano_id' => $dados['plano_id_func'],
                        'data_expiracao' => (new Carbon())->addMonths($dados['tempoPlanoFunc']),
                        'created_at' => now(),
                        'updated_at' => now()
                    ];
                    
                    DB::table('aluno_plano')->insert($dadosFunc);
                }
                if(isset($dados['plano_id_fut'])){
                    $dadosFut = [
                        'aluno_id' => $aluno->id, 
                        'plano_id' => $dados['plano_id_fut'], 
                        'data_expiracao' => (new Carbon())->addMonths($dados['tempoPlanoFut']),
                        'created_at' => now(),
                        'updated_at' => now()
                    ];
                        
                    DB::table('aluno_plano')->insert($dadosFut);
                }
                
                $response = redirect()->route('listagem-alunos', 'todos')->withStatus(__('Aluno cadastrado com sucesso.'));
            } else {
                $response = back()->withInput()->with('erro', 'Selecione ao menos um plano!!!');
            }
        } catch (QueryException $e){
            $response = back()->withInput()->with('erro', $e->getMessage());
        } finally{
            return $response;
        }        
    }

    public function editar($id)
    {
        $aluno = Aluno::firstWhere('id', $id);            
        $alunoPlanos = DB::table('aluno_plano')->where('aluno_id', $id)->pluck('plano_id')->toArray();

        $planos_futvolei = Plano::where('categoria_id', '=', 1)->get();
        $planos_funcional = Plano::where('categoria_id', '=', 2)->get();
        
        $temposDePlano = [];

        foreach($alunoPlanos as $idPlano){
            $plano = Plano::firstWhere('id', $idPlano);
            $temposDePlano[$plano->categoria->tipo] = $aluno->tempoDoPlano($idPlano);
        }
        
        $dados = [
            'funcionais' => $planos_funcional,
            'futvolei' => $planos_futvolei,
            'aluno' => $aluno,
            'alunoPlanos' => $alunoPlanos,
            'temposDePlano' => $temposDePlano,
        ];

        return view('aluno.cadastro-aluno', $dados);
    }

    public function atualizarAluno(Request $request, $id)
    {
        $dados = $request->all();

        $aluno = Aluno::firstWhere('id', $id);            
        $aluno->fill($dados);
        $aluno->data_expiracao = now();
        $aluno->save();

        if(isset($dados['plano_id_func']) || isset($dados['plano_id_fut'])){
            $this->atualizarPlano($id, 1, $dados['plano_id_fut'] ?? null, $dados['tempoPlanoFut']);
            $this->atualizarPlano($id, 2, $dados['plano_id_func'] ?? null, $dados['tempoPlanoFunc']);

            $response = redirect()->route('listagem-alunos', ['categoria' => 'todos'])->with('sucesso', 'Cadastro Atualizado!');
        } else {
            $response = back()->withInput()->with('erro', 'Selecione ao menos um plano!');
        }

        return $response;
    }

    private function atualizarPlano($alunoId, $categoriaId, $planoId, $tempoPlano)
    {
        $plano = DB::table('aluno_plano')->where('aluno_id', $alunoId)
                                         ->join('planos', 'planos.id', '=', 'plano_id')
                                         ->where('planos.categoria_id', '=', $categoriaId)
                                         ->first(['aluno_plano.id', 'aluno_plano.created_at']);
        if(isset($planoId)){
            $dados = [
                'aluno_id' => $alunoId,
                'plano_id' => $planoId,
                'updated_at' => now(),
            ];
            if(isset($plano)){
                $dados['data_expiracao'] = (Carbon::parse($plano->created_at))->addMonths($tempoPlano);
                DB::table('aluno_plano')->where('id', '=', $plano->id)->update($dados);
            } else {
                $dados['created_at'] = now();
                $dados['data_expiracao'] = (new Carbon())->addMonths($tempoPlano);
                DB::table('aluno_plano')->insert($dados);
            }
        } elseif (isset($plano)){
            DB::table('aluno_plano')->where('id', $plano->id)->delete();
        }
    }

    public function deletarPresenca($id)
    {
        $presenca = PresencaAluno::firstWhere('id', $id);
        $presenca->delete();

        return redirect()->route('inicio')->with('sucesso', "Presenca deletada!!!");
    }
}
