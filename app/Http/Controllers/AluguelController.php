<?php

namespace App\Http\Controllers;

use App\Aluguel;
use Illuminate\Http\Request;

class AluguelController extends Controller
{

    public function listar_aluguel()
    {
        $alugueis = Aluguel::all();
        return view('aluguel.listagem-aluguel', ['alugueis' => $alugueis]);
    }

    public function filtrar_aluguel_cpf(Request $request)
    {
        $busca = trim($request->busca);
        $busca = strtolower($busca);

        if ($busca === null || $busca === '') {
            $lista = Aluguel::all();
            return view('aluguel.listagem-aluguel', ['alugueis' => $lista]);
        }
        $busca = $this->verificaCpf($request->busca);
        if ($busca) { //após a verificação, valida se é um CPF, se for entra nesse primeiro if, caso contrario ele busca por nome
            $cpf = $this->limpaCPF_CNPJ($request->busca);
            $alugueis = Aluguel::where('cpf', '=', $cpf)->get();
            return view('aluguel.listagem-aluguel', ['alugueis' => $alugueis]);
        } else {
            $alugueis = Aluguel::where('nome', 'like',  '%' . $request->busca . '%')->get();
            return view('aluguel.listagem-aluguel', ['alugueis' => $alugueis]);
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    public function save(Request $request)
    {   
        $dados = $request->all();
        try {
            $aluguel = new Aluguel();
            $aluguel->cpf = $dados['cpf'];
            $aluguel->nome = $dados['nome'];
            $aluguel->data = $dados['data'];
            $aluguel->tempo = $dados['tempo'];
            if($dados['turno'] == 3){
                $aluguel->turno = 'Dia';
            }
            if ($dados['turno'] == 4) {
                $aluguel->turno = 'Noite';
            }
            if ($dados['turno'] == 3) {
                if($dados['tempo'] == 1){
                    $aluguel->valor = 60.0;
                } elseif($dados['tempo'] == 2){
                    $aluguel->valor = 110.0;
                }
            }  elseif ($dados['turno'] == 4) {
                if ($dados['tempo'] == 1) {
                    $aluguel->valor = 70.0;
                } elseif ($dados['tempo'] == 2) {
                    $aluguel->valor = 130.0;
                }
            }
            $aluguel->save();
            return redirect()->route('listagem-aluguel')->withStatus(__('Aluguel cadastrado com sucesso!'));
        } catch (\Exception $e) {
            return redirect()->route('listagem-aluguel')->withErros(__('Erro ao cadastrar Aluguel'));
        } 
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Aluguel  $aluguel
     * @return \Illuminate\Http\Response
     */
    public function show(Aluguel $aluguel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Aluguel  $aluguel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $aluguel = Aluguel::find($id);
            $aluguel->delete();
            return redirect()->route('listagem-aluguel')->withStatus(__('Aluguel removido da listagem'));
        } catch (\Exception $e) {
            return redirect()->route('listagem-aluguel')->withErros(__('Erro ao deletar Aluguel'));
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
}
