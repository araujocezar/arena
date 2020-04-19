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
                                            <label for="nome">Nome</label>
                                            <input type="text" id="nome" class="form-control">
                                        </div>
                                        <div class="col-5" style="margin-left: 48px;">
                                            <label for="cpf">CPF</label>
                                            <input type="text" id="cpf" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-row" style="margin-top: 12px;">
                                        <div class="col-5" style="margin-top: 6px;">
                                            <label for="email">Email</label>
                                            <input type="text" id="email" class="form-control">
                                        </div>
                                        <div class="col-5" style="margin-left: 48px;">
                                            <label for="sexo">Sexo:</label>
                                            <select class="form-control" id="sexo">
                                                <option>Feminino</option>
                                                <option>Masculino</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row" style="margin-top: 12px;">
                                        <div class="col-5">
                                            <label for="telefone">Telefone</label>
                                            <input type="text" id="telefone" class="form-control">
                                        </div>
                                        <div class="col-5" style="margin-left: 48px;">
                                            <label for="data_cadastro">Data:</label>
                                            <input type="text" id="data_cadastro" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="content">
                            <div class="card-header">
                                <h4><strong>Selecione o plano</strong></h4>
                            </div>
                            <div class="card-header row">
                                <div class="teste col-sm">
                                    <h4><strong>FUNCIONAL</strong></h4>
                                </div>
                                <div class="col-sm">
                                    <h4><strong>FUTVÔLEI</strong></h4>
                                </div>
                                <div class="col-sm">
                                    <h4><strong>COMBO</strong></h4>
                                </div>
                            </div>
                            <div class="card-header row">
                                <div class="col-sm card">
                                    @foreach ($funcionais as $func)
                                    <div class="container-radio column">
                                        <div>
                                            <label>
                                                <input type="radio" name="plano_id" class="card-input-element" value="$func->id" />
                                                <div class="panel panel-default card-input">
                                                    <div class="panel-heading" style="color:black"><strong>{{$func->descricao}}</strong></div>
                                                    <div class="panel-body column">
                                                        <div>
                                                            Modalidade: Funcional
                                                        </div>
                                                        <div>
                                                            Dias na semana: {{$func->dias_semana}}
                                                        </div>
                                                        <div>
                                                            Valor: R$ {{$func->preco}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="col-sm card">
                                    @foreach ($futvolei as $fut)
                                    <div class="container-radio column">
                                        <div>
                                            <label>
                                                <input type="radio" name="plano_id" class="card-input-element" value="$fut->id" />
                                                <div class="panel panel-default card-input">
                                                    <div class="panel-heading " style="color:black"><strong>{{$fut->descricao}}</strong></div>
                                                    <div class="panel-body column">
                                                        <div>
                                                            Modalidade: Futvôlei
                                                        </div>
                                                        <div>
                                                            Dias na semana: {{$fut->dias_semana}}
                                                        </div>
                                                        <div>
                                                            Valor: R$ {{$fut->preco}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="col-sm card">
                                    <div class="container-radio column">
                                        <div>
                                            <label>
                                                <input type="radio" name="plano_id" class="card-input-element" />
                                                <div class="panel panel-default card-input">
                                                    <div class="panel-heading" style="color:black"><strong>Combo 1 </strong></div>
                                                    <div class="panel-body column">
                                                        <div>
                                                            Modalidade: Funcional e Futvôlei
                                                        </div>
                                                        <div>
                                                            Dias na semana: 5
                                                        </div>
                                                        <div>
                                                            Valor: R$ 500,00
                                                        </div>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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

<style>
    .card-input-element {
        display: none;
    }

    .card-input {
        margin: 10px;
        padding: 00px;
    }

    .card-input:hover {
        cursor: pointer;
    }

    .card-input-element:checked+.card-input {
        box-shadow: 0 0 1px 1px #2ecc71;
    }
</style>