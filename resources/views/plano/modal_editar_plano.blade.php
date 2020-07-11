<!-- Modal -->
<div class="modal fade" id="editarPlanoModal{{ $plano->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><strong>Editar Plano</strong> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('plano.atualizar', $plano->id) }}" method="post" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <div class="form-column">
                        <div class="col-12">
                            <label for="descricao">Descrição do plano</label>
                            <input type="text" id="descricao" name="descricao" value="{{ $plano->descricao }}" class="form-control {{ $errors->has('descricao') ? ' is-invalid' : '' }}" required>
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
                            <option {{ $plano->dias_semana == 1 ? 'selected' : '' }}>1</option>
                            <option {{ $plano->dias_semana == 2 ? 'selected' : '' }}>2</option>
                            <option {{ $plano->dias_semana == 3 ? 'selected' : '' }}>3</option>
                            <option {{ $plano->dias_semana == 4 ? 'selected' : '' }}>4</option>
                            <option {{ $plano->dias_semana == 5 ? 'selected' : '' }}>5</option>
                        </select>
                    </div>
                    <div class="form-group col-12">
                        <label for="tipo">Selecione uma categoria:</label>
                        <select required autofocus class="form-control" id="categoria_id" name="categoria_id">
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}" {{ $plano->categoria_id == $categoria->id ? 'selected' : '' }}>{{ $categoria->tipo }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="preco">Valor(R$)</label>
                        <input required type="number" step="0.01" min="0" id="preco" name="preco" value="{{ $plano->preco }}" class="form-control">
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