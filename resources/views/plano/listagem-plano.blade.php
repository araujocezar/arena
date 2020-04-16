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
                        <div class="row ">
                            <div class="col-12 text-right">
                                <button type="button" class="btn btn-sm btn-primary " data-toggle="modal" data-target="#exampleModal">
                                    Novo Plano
                                </button>
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
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><strong>Cadastrar novo Plano</strong> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-column">
                        <div class="col-12">
                            <label for="descricao">Descrição do plano</label>
                            <input type="text" id="descricao" class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-12">
                        <label for="dias_semana">Selecione quantos dias na semana:</label>
                        <select class="form-control" id="dias_semana">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                    <div class="form-group col-12">
                        <label for="tipo">Selecione uma categoria:</label>
                        <select class="form-control" id="tipo">
                            @foreach ($categorias as $categoria)
                            <option value="{{$categoria->id}}">{{$categoria->tipo}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="preco">Valor(R$)</label>
                        <input type="number" id="preco" class="form-control">
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