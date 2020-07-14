<?php

namespace App\Http\Controllers;

use App\Aluno;
use App\Categoria;
use App\Plano;
use Illuminate\Support\Facades\DB;

class RelatorioController extends Controller
{
    public function index()
    {
        $categorias = json_encode(Categoria::all('tipo')->pluck('tipo')->toArray());
        $alunosPorCategoria = [];
        $rendaPorCategoria = [];

        foreach (Categoria::all() as $categoria) {
            $idDosPlanos = Plano::where('categoria_id', $categoria->id)->pluck('id')->toArray();
            $alunosPorCategoria[] = DB::table('aluno_plano')->whereIn('plano_id', $idDosPlanos)->count();

            $rendaPorCategoria[] = $this->calcularRendaCategoria($categoria->id);
        }

        $dados = [
            'categorias' => $categorias,
            'alunosPorCategoria' => json_encode($alunosPorCategoria),
            'rendaPorCategoria' => json_encode($rendaPorCategoria),
            'meses' => json_encode(['JAN', 'FEV', 'MAR', 'ABR', 'MAI', 'JUN', 'JUL', 'AGO', 'SET', 'OUT', 'NOV', 'DEZ']),
            'matriculasPorMes' => $this->matriculasPorMes(),
        ];

        return view('relatorio/index', $dados);
    }

    private function matriculasPorMes()
    {
        $matriculasPorMes = [];

        for ($mes = 1; $mes <= 12; ++$mes) {
            $matriculasPorMes[] = Aluno::whereYear('created_at', date('Y'))->whereMonth('created_at', $mes)->count();
        }

        return json_encode($matriculasPorMes);
    }

    private function calcularRendaCategoria($categoriaId)
    {
        $totalCategoria = 0;

        $planosDaCategoria = Plano::where('categoria_id', $categoriaId)->get();
            
        foreach ($planosDaCategoria as $plano) {
            $quantAlunos = DB::table('aluno_plano')->where('plano_id', $plano->id)->count();
            $totalCategoria += ($plano->preco * $quantAlunos);
        }

        return $totalCategoria;
    }
}
