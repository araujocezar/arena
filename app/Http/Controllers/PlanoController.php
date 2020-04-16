<?php

namespace App\Http\Controllers;

use App\Categoria;
use Illuminate\Http\Request;
use App\Plano;


class PlanoController extends Controller
{
    public function listar_plano()
    {
        $lista = Plano::all();
        $categorias = Categoria::all();
        return view('plano.listagem-plano', ['planos' => $lista, 'categorias' => $categorias]);
    }

    public function criar_plano()
    {
        $categorias = Categoria::all();
        return view('plano.criar-plano', ['categorias' => $categorias]);
    }
}
