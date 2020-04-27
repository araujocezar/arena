@extends('layouts.app', ['activePage' => 'listagem-planos', 'titlePage' => __('Listar Planos')])

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
                                            <form action="{{ route('plano.destroy', $plano->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button >
                                                <a rel="tooltip" class="btn btn-success btn-link" href="#editarModal" data-original-title="" title="">
                                                    <i class="material-icons">edit</i>
                                                    <div class="ripple-container"></div>
                                                </a>
                                                <button type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick="confirm('{{ __('Você tem certeza que deseja deletar esse plano?') }}') ? this.parentElement.submit() : ''">
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
                <form action="{{ route('plano.save') }}" method="post" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    @method('post')

                    <div class="form-column">
                        <div class="col-12">
                            <label for="descricao">Descrição do plano</label>
                            <input type="text" id="descricao" name="descricao" class="form-control {{ $errors->has('descricao') ? ' is-invalid' : '' }}" required>
                            @if ($errors->has('descricao'))
                                <span id="email-error" class="error text-danger"
                                      for="input-email">{{ $errors->first('descricao') }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group col-12">
                        <label for="dias_semana">Selecione quantos dias na semana:</label>
                        <select required autofocus class="form-control" id="dias_semana" name="dias_semana">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                    <div class="form-group col-12">
                        <label for="tipo">Selecione uma categoria:</label>
                        <select required autofocus class="form-control" id="categoria_id" name="categoria_id">
                            @foreach ($categorias as $categoria)
                                <option value="{{$categoria->id}}">{{$categoria->tipo}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="preco">Valor(R$)</label>
                        <input required type="number" step="0.01" min="0" id="preco" name="preco" class="form-control">
                    </div>
                    <div class=" modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


//modal editar
<!-- Modal -->
<div class="modal fade" id="editarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><strong>Cadastrar novo Plano</strong> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('plano.save') }}" method="post" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    @method('post')

                    <div class="form-column">
                        <div class="col-12">
                            <label for="descricao">Descrição do plano</label>
                            <input type="text" id="descricao" name="descricao" class="form-control {{ $errors->has('descricao') ? ' is-invalid' : '' }}" required>
                            @if ($errors->has('descricao'))
                                <span id="email-error" class="error text-danger"
                                      for="input-email">{{ $errors->first('descricao') }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group col-12">
                        <label for="dias_semana">Selecione quantos dias na semana:</label>
                        <select required autofocus class="form-control" id="dias_semana" name="dias_semana">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                    <div class="form-group col-12">
                        <label for="tipo">Selecione uma categoria:</label>
                        <select required autofocus class="form-control" id="categoria_id" name="categoria_id">
                            @foreach ($categorias as $categoria)
                                <option value="{{$categoria->id}}">{{$categoria->tipo}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="preco">Valor(R$)</label>
                        <input required type="number" step="0.01" min="0" id="preco" name="preco" class="form-control">
                    </div>
                    <div class=" modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection