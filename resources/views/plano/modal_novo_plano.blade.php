<div class="modal fade" id="novoPlanoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <span id="email-error" class="error text-danger" for="input-email">{{ $errors->first('descricao') }}
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
                        <label for="preco">Valor Mensal(R$)</label>
                        <input required type="number" step="0.01" min="0" id="preco" name="preco" class="form-control">
                    </div>
                    <div class="col-12">
                        <label for="preco">Valor Trimestral(R$)</label>
                        <input required type="number" step="0.01" min="0" id="preco_trimestral" name="preco_trimestral" class="form-control">
                    </div>
                    <div class="col-12">
                        <label for="preco">Valor Semestral(R$)</label>
                        <input required type="number" step="0.01" min="0" id="preco_semestral" name="preco_semestral" class="form-control">
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