<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Validators\PlanoValidator;
use Illuminate\Http\Request;
use App\Plano;


class PlanoController extends Controller
{
    public function listar_plano()
    {
        $lista = Plano::all();
        $categorias = Categoria::all();
        return view('plano.listagem-planos', ['planos' => $lista, 'categorias' => $categorias]);
    }

    public function save(Request $request)
    {
        PlanoValidator::validate($request->all());
        $plano = new Plano();
        $plano->fill($request->all());
        $plano->save();
        $lista = Plano::all();
        $categorias = Categoria::all();
        return redirect()->route('listagem-planos', ['planos' => $lista, 'categorias' => $categorias]);
    }

    public function edit($id){
        $plano = Plano::find($id);
        $categorias = Categoria::all();
        return view('plano.edit', ['plano' => $plano, 'categorias' => $categorias]);

    }

    public function destroy($id)
    {
        try{
            $plano = Plano::find($id);
            $plano->delete();
            return redirect()->route('listagem-planos')->withStatus(__('Plano removido com sucesso'));
        }catch (\Exception $e){
            return redirect()->route('listagem-planos')->withErros(__('Erro ao deletar plano'));
        }
    }
}
