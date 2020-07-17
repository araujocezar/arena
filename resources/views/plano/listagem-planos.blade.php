@extends('layouts.app', ['activePage' => 'listagem-planos', 'titlePage' => __('Listar Planos')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="table-responsive">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">Listar Planos</h4>
                    </div>
                    <div class="card-body">
                        <div class="row ">
                            <div class="col-12 text-right">
                                <button type="button" class="btn btn-sm btn-primary " data-toggle="modal" data-target="#novoPlanoModal">
                                    Novo Plano
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            @if(session('erro'))
                            <div class="alert alert-danger">{{ session('erro') }}</div>
                            @elseif(session('sucesso'))
                            <div class="alert alert-success">{{ session('sucesso') }}</div>
                            @endif
                            <table class="table">
                                <thead class=" text-primary">
                                    <th>
                                        Descrição
                                    </th>
                                    <th>
                                        Dias na semana
                                    </th>
                                    <th>
                                        Preço
                                    </th>
                                    <th>
                                        Categoria
                                    </th>
                                    <th>
                                        Opções
                                    </th>
                                </thead>
                                <tbody>
                                    @foreach($planos as $plano)
                                    <tr>
                                        <td>
                                            {{ $plano->descricao }}
                                        </td>
                                        <td>
                                            {{ $plano->dias_semana}}
                                        </td>
                                        <td>
                                            R$ {{ $plano->preco }}
                                        </td>
                                        <td>
                                            {{ $plano->categoria->tipo }}
                                        </td>
                                        <td class="input-group-append">
                                            <button type='button' class="btn btn-sm btn-success btn-link" data-toggle="modal" 
                                                data-target="#editarPlanoModal{{ $plano->id}}">
                                                <i class="material-icons">edit</i>
                                            </button>
                                            @include('plano/modal_editar_plano', ['plano' => $plano ])
                                            <form action="{{ route('plano.destroy', $plano->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-sm btn-danger btn-link"
                                                    onclick="return confirm('{{ __('Você tem certeza que deseja deletar esse plano?') }}')">
                                                    <i class="material-icons">delete</i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $planos->links() }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@include('plano/modal_novo_plano')

@endsection