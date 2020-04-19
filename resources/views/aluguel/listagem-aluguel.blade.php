@extends('layouts.app', ['activePage' => 'listagem-aluguel', 'titlePage' => __('Listagem de alugueis')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">Aluguel de Quadra</h4>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <i class="material-icons">close</i>
                                    </button>
                                    <span>{{ session('status') }}</span>
                                </div>
                            </div>
                        </div>
                        @endif
                        <form method="POST" action="{{ route('listagem-aluguel') }}">
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
                        <div class="row " style="margin-top: 32px;">
                            <div class="col-12 text-right">
                                <button type="button" class="btn btn-sm btn-primary " data-toggle="modal" data-target="#exampleModal">
                                    Novo Aluguel
                                </button>
                            </div>
                        </div>
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
                                        Data de Aluguel
                                    </th>
                                    <th>
                                        Tempo(horas)
                                    </th>
                                </thead>
                                <tbody>
                                    @foreach($alugueis as $aluguel)
                                    <tr>
                                        <td>
                                            {{ $aluguel->cpf }}
                                        </td>
                                        <td>
                                            {{ $aluguel->nome }}
                                        </td>
                                        <td>
                                            {{ $aluguel->data }}
                                        </td>
                                        <td>
                                            {{ $aluguel->tempo }} Hora(s)
                                        </td>
                                        <td class="td-actions text-right">
                                            <form action="{{ route('aluguel.destroy', $aluguel->id)}}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick="confirm('{{ __('Você tem certeza que deseja deletar esse registro de Aluguel?') }}') ? this.parentElement.submit() : ''">
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
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><strong>Novo aluguel</strong> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-column">
                        <div class="col-12">
                            <label for="nome">Nome</label>
                            <input type="text" id="nome" class="form-control">
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="cpf">CPF</label>
                        <input type="text" id="cpf" class="form-control">
                    </div>
                    <div class="col-12">
                        <label for="data">Data</label>
                        <input type="number" id="data" class="form-control">
                    </div>
                    <div class="form-group col-12">
                        <label for="tempo">Selecione quantas horas</label>
                        <select class="form-control" id="tempo">
                            <option>1</option>
                            <option>2</option>
                        </select>
                    </div>

                </form>
            </div>
            <div class=" modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </div>
</div>
@endsection