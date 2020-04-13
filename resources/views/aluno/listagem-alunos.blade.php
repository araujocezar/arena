@extends('layouts.app', ['activePage' => 'listagem-alunos', 'titlePage' => __('Listagem dos Alunos')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">Listagem dos Alunos</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('listagem-alunos', 'todos') }}">
                            {{ csrf_field() }}
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <input name="busca" id="busca" type="text" class="form-control" placeholder="Buscar por Nome ou CPF" value={{ old('busca')}}> {{ $errors->first('busca')}}
                                </div>
                                <div class="col-md-auto">
                                    <button type="submit" class="btn btn-primary">
                                        Buscar
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <th>
                                        CPF
                                    </th>
                                    <th>
                                        Nome
                                    </th>
                                    <th>
                                        Telefone
                                    </th>
                                    <th>
                                        Data de Pagamento
                                    </th>
                                </thead>
                                <tbody>
                                    @foreach($alunos as $aluno)
                                    <tr>
                                        <td>
                                            {{ $aluno->cpf }}
                                        </td>
                                        <td>
                                            {{ $aluno->nome }}
                                        </td>
                                        <td>
                                            {{ $aluno->telefone }}
                                        </td>
                                        <td>
                                            {{ $aluno->data_cadastro }}
                                        </td>
                                        <td class="td-actions text-right">
                                            <form action="{{ route('delete-aluno', $aluno->id) }}" method="post">
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