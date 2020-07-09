<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Plano;
use Illuminate\Support\Facades\DB;

class RelatorioController extends Controller
{
    public function index()
    {
        $categorias = json_encode(Categoria::all('tipo')->pluck('tipo')->toArray());
        $alunosPorPlano = [];
        $rendaPorCategoria = [];

        foreach (Categoria::all() as $categoria) {
            $planos = Plano::where('categoria_id', $categoria->id)->pluck('id')->toArray();
            $alunosPorPlano[] = DB::table('aluno_plano')->whereIn('plano_id', $planos)->count();

            $totalCategoria = 0;

            foreach (Plano::all() as $plano) {
                if ($plano->categoria_id == $categoria->id) {
                    $quantAlunos = DB::table('aluno_plano')->where('plano_id', $plano->id)->count();
                    $totalCategoria += ($plano->preco * $quantAlunos);
                }
            }

            $rendaPorCategoria[] = $totalCategoria;
            $totalCategoria = 0;
        }

        $matriculasPorMes = [];

        for ($mes = 1; $mes <= 12; ++$mes) {
            $matriculasPorMes[] = DB::table('aluno_plano')->whereYear('created_at', date('Y'))->whereMonth('created_at', $mes)->count();
        }

        $dados = [
            'categorias' => $categorias,
            'alunosPorPlano' => json_encode($alunosPorPlano),
            'rendaPorCategoria' => json_encode($rendaPorCategoria),
            'meses' => json_encode(['JAN', 'FEV', 'MAR', 'ABR', 'MAI', 'JUN', 'JUL', 'AGO', 'SET', 'OUT', 'NOV', 'DEZ']),
            'matriculasPorMes' => json_encode($matriculasPorMes),
        ];

        return view('relatorio/index', $dados);
    }
}
