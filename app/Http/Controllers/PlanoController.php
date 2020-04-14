<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plano;


class PlanoController extends Controller
{
    public function listar_plano()
    {
        $lista = Plano::all();
        return view('plano.listagem-plano', ['planos' => $lista]);
    }
}
