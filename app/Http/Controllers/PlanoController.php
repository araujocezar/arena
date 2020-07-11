<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Validators\PlanoValidator;
use Illuminate\Http\Request;
use App\Plano;
use Laravel\Ui\Presets\React;

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
        
        return redirect()->route('listagem-planos');
    }

    public function edit($id){
        $plano = Plano::find($id);
        $categorias = Categoria::all();
        return view('plano.edit', ['plano' => $plano, 'categorias' => $categorias]);

    }

    public function atualizar(Request $request, $id){

        $plano = Plano::find($id);
        
        if(isset($plano)){
            $plano->update($request->all());
            $response = redirect()->route('listagem-planos')->with('sucesso', 'Plano Atualizado!!!');
        } else {
            $response = redirect()->route('listagem-planos')->with('erro', 'Falha ao atualizar!!!');
        }

        return $response;
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
