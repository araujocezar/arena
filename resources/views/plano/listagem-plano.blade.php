@extends('layouts.app', ['activePage' => 'listagem-plano', 'titlePage' => __('Listar Planos')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">Listar Planos</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 text-right">
                                <a href="{{ route('cadastro-plano') }}" class="btn btn-sm btn-primary">{{ __('Novo Plano') }}</a>
                            </div>
                        </div>
                        <div class="table-responsive">
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
                                            {{ $plano->preco }}
                                        </td>
                                        <td>
                                            {{ $plano->categorias->tipo }}
                                        </td>
                                        <td class="td-actions text-right">
                                            <form action="{{ route('listagem-alunos', 'todos') }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <a rel="tooltip" class="btn btn-success btn-link" href="{{  route('listagem-alunos', 'todos')  }}" data-original-title="" title="">
                                                    <i class="material-icons">edit</i>
                                                    <div class="ripple-container"></div>
                                                </a>
                                                <button type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick="confirm('{{ __('Você tem certeza que deseja deletar esse aluno?') }}') ? this.parentElement.submit() : ''">
                                                    <i class="material-icons">delete</i>
                                                    <div class="ripple-container"></div>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection