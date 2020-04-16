@extends('layouts.app', ['activePage' => 'cadastro-aluno', 'titlePage' => __('Cadastro de Aluno')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">Cadastro de Aluno</h4>
                    </div>
                    <div class="card-body">
                        <form>
                            <div style="padding: 48px;">
                                <div class="form-column">
                                    <div class="form-row">
                                        <div class="col-5">
                                            <label for="descricao">Nome</label>
                                            <input type="text" id="descricao" class="form-control">
                                        </div>
                                        <div class="col-5" style="margin-left: 48px;">
                                            <label for="descricao">CPF</label>
                                            <input type="text" id="descricao" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-row" style="margin-top: 12px;">
                                        <div class="col-5" style="margin-top: 6px;">
                                            <label for="descricao">Email</label>
                                            <input type="text" id="descricao" class="form-control">
                                        </div>
                                        <div class="col-5" style="margin-left: 48px;">
                                            <label for="dias_semana">Sexo:</label>
                                            <select class="form-control" id="dias_semana">
                                                <option>Feminino</option>
                                                <option>Masculino</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row" style="margin-top: 12px;">
                                        <div class="col-5">
                                            <label for="descricao">Telefone</label>
                                            <input type="text" id="descricao" class="form-control">
                                        </div>
                                        <div class="col-5" style="margin-left: 48px;">
                                            <label for="dias_semana">Data:</label>
                                            <input type="text" id="descricao" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-4 col-md-11">
                        <button type="submit" class="btn btn-primary pull-right" style="width: 140px;">SALVAR</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection