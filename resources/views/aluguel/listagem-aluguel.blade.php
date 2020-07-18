@extends('layouts.app', ['activePage' => 'listagem-aluguel', 'titlePage' => __('Listagem de alugueis de quadras')])

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
                                    <th>
                                        Turno
                                    </th>
                                    <th>
                                        Valor
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
                                        <td>
                                            {{ $aluguel->turno }}
                                        </td>
                                        <td>
                                            R$ {{ $aluguel->valor }}
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
                <form action="{{ route('aluguel.save') }}" method="post" class="form-horizontal" enctype="multipart/form-data" id="form-modal">
                    @csrf
                    @method('post')
                    <div class="form-column">
                        <div class="col-12">
                            <label for="nome">Nome</label>
                            <input type="text" id="nome" class="form-control" name="nome" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="cpf">CPF</label>
                        <input minlength="14" maxlength="14" class="form-control" id="cpfmask" name="cpf" required>
                        <script type="text/javascript">
                            $('#cpfmask').mask('000.000.000-00');
                        </script>
                    </div>
                    <div class="col-12">
                        <label for="data">Data</label>
                        <input class="form-control" id="datepicker" type="text" name='data' required autocomplete="off">
                        <script type="text/javascript">
                            $('#datepicker').datepicker({
                                dateFormat: 'dd-mm-yy',
                            });
                        </script>
                    </div>
                    <div class="form-group col-12">
                        <label for="tempo">Selecione quantas horas</label>
                        <select class="form-control" id="tempo" name="tempo" required>
                            <option>1</option>
                            <option>2</option>
                        </select>
                    </div>
                    <div class="form-group col-12">
                        <label for="turno">Selecione o turno</label>
                        <select class="form-control" id="turno" name="turno" required>
                            <option value="3">Manhã</option>
                            <option value="4">Noite</option>
                        </select>
                    </div>

                </form>
            </div>
            <div class=" modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button form="form-modal" value="Submit" type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </div>
</div>
@endsection