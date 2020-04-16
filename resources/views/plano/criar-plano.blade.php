@extends('layouts.app', ['activePage' => 'criar-plano', 'titlePage' => __('Cadastrar Plano')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">Cadastrar Plano</h4>
                    </div>
                    </br>
                    <div class="card-body" style="margin-left: 12px;">
                        <form>
                            <div class="form-row">
                                <div class="col-11" style="margin-top: 33px;">
                                    <input type="text" class="form-control" placeholder="Descrição do plano">
                                </div>
                            </div>
                            </br>
                            <div class="form-row">
                                <div class="form-group col-2">
                                    <label for="dias_semana">Selecione quantos dias na semana:</label>
                                    <select class="form-control" id="dias_semana">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div>
                                <div class="col-4" style="margin-top: 8px;">
                                    <label for="tipo">Selecione uma categoria:</label>
                                    <select class="form-control" id="tipo">
                                        @foreach ($categorias as $categoria)
                                        <option value="{{$categoria->id}}">{{$categoria->tipo}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-3 " style="margin-top: 42px;">
                                    <input type="text" class="form-control" placeholder="Valor(R$)">
                                </div>
                            </div>
                        </form>
                        </br>
                        </br>
                        </br>
                        <div class="col-sm-4 col-md-11">
                            <button type="submit" class="btn btn-primary pull-right" style="width: 140px;">SALVAR</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection