@extends('layouts.app', ['activePage' => isset($aluno) ? 'listagem-alunos':'cadastro-aluno', 'titlePage' => __('Cadastro de Aluno')])

@section('content')

<body>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{ isset($aluno) ? 'Editar Aluno' : "Cadastro de Aluno"}}</h4>
                        </div>
                        <div class="card-body">

                            @if(session('erro'))
                            <div class="alert alert-danger">{{ session('erro') }}</div>
                            @elseif(session('sucesso'))
                            <div class="alert alert-success">{{ session('sucesso') }}</div>
                            @endif

                            <form action="{{ isset($aluno) ? route('aluno.update', $aluno->id) : route('aluno.save') }}" method="post" autocomplete="on" class="form-horizontal" enctype="multipart/form-data">
                                @csrf
                                @if(isset($aluno))
                                @method('put')
                                @else
                                @method('post')
                            @endif
                            <div style="padding: 48px;">
                                <div class="form-column">
                                    <div class="form-row">
                                        <div class="col-5">
                                            <label for="nome">Nome</label>
                                            <input type="text" id="nome" name="nome" class="form-control" value="{{ $aluno->nome ?? old('nome') }}" required>
                                            @if ($errors->has('nome'))
                                                <span id="nome_item-error" class="error text-danger"
                                                      for="input-nome">{{ $errors->first('nome') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-5" style="margin-left: 48px;">
                                            <label for="cpf">CPF</label>
                                            <input type="text" minlength="14" maxlength="14" class="form-control" id="cpfmask" name="cpf" value="{{ $aluno->cpf ?? old('cpf') }}" required>
                                            @if ($errors->has('cpf'))
                                                <span id="nome_item-error" class="error text-danger"
                                                      for="input-nome">{{ $errors->first('cpf') }}</span>
                                            @endif
                                            <script type="text/javascript">
                                                $('#cpfmask').mask('000.000.000-00');
                                            </script>
                                        </div>
                                    </div>
                                    <div class="form-row" style="margin-top: 12px;">
                                            <div class="col-5" style="margin-top: 6px;">
                                                <label for="email">Email</label>
                                                <input type="text" id="email" name="email" class="form-control" value="{{ $aluno->email ?? old('email') }}">
                                            </div>
                                            <div class="col-2" style="margin-left: 48px;">
                                                <label for="sexo">Sexo:</label>
                                                <select class="form-control" id="sexo" name="sexo">
                                                    @if (isset($aluno))
                                                    <option {{ $aluno->sexo == 'Feminino' ? 'selected' : '' }}>Feminino</option>
                                                    <option {{ $aluno->sexo == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                                    @else
                                                    <option></option>
                                                    <option {{ old('sexo') == 'Feminino' ? 'selected' : '' }}>Feminino</option>
                                                    <option {{ old('sexo') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="col-3" style="margin-top: 6px;margin-left: 8px;">
                                                <label for="telefone">Telefone</label>
                                                <input type="text" id="telefonemask" name="telefone" class="form-control" value="{{ $aluno->telefone ?? old('telefone') }}" pattern="\([0-9]{2}\)[\s][0-9]{4}-[0-9]{4,5}">
                                                <script type="text/javascript">
                                                    $('#telefonemask').mask('(00) 0000-00009');
                                                </script>
                                            </div>
                                        </div>
                                        <div class="form-row" style="margin-top: 12px;">
                                            
                                        </div>
                                        <div class="form-row" style="margin-top: 12px;">
                                            <div class="col-5">
                                                <label for="data_cadastro">Data do Cadastro</label>
                                                <input class="form-control" id="datepicker" type="text" name='data_cadastro' value="{{ $aluno->data_cadastro ?? old('data_cadastro') }}" autocomplete="off">
                                                <script type="text/javascript">
                                                    $('#datepicker').datepicker({
                                                        dateFormat: 'dd-mm-yy',
                                                    });
                                                </script>
                                            </div>
                                            <div class="col-5" style="margin-left: 48px;">
                                                <label for="datepicker_data_nascimento">Data do Nascimento</label>
                                                <input class="form-control" id="datepicker_data_nascimento" type="text" name='data_nascimento' value="{{ $aluno->data_nascimento ?? old('data_nascimento') }}" autocomplete="off">
                                                <script type="text/javascript">
                                                    $('#datepicker_data_nascimento').datepicker({
                                                        dateFormat: 'dd-mm-yy',
                                                        changeYear: true,
                                                        changeMonth: true,
                                                        yearRange: '1910:2020'
                                                    });
                                                </script>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        <div class="content">
                            <div class="card-header row">    
                                <div class="content">
                                    <div class="card-header">
                                        <h4><strong>Selecione o plano</strong></h4>
                                    </div>
                                    <div class="card-header row">
                                        <div class="teste col-sm">
                                            <h4><strong>FUNCIONAL</strong></h4>
                                            <div class="col-sm">
                                                <label for="dale">Tempo de Plano</label>
                                                <select class="form-control" name="tempoPlanoFunc">
                                                    @if(isset($temposDePlano['funcional']))
                                                    <option value="1" {{ $temposDePlano['funcional'] == 1 ? 'selected' : '' }}>Mensal</option>
                                                    <option value="3" {{ $temposDePlano['funcional'] == 3 ? 'selected' : '' }}>Trimestral </option>
                                                    <option value="6" {{ $temposDePlano['funcional'] == 6 ? 'selected' : '' }}>Semestral </option>
                                                    @else
                                                    <option value="1" {{ old('tempoPlanoFunc') == 1 ? 'selected' : '' }}>Mensal</option>
                                                    <option value="3" {{ old('tempoPlanoFunc') == 3 ? 'selected' : '' }}>Trimestral </option>
                                                    <option value="6" {{ old('tempoPlanoFunc') == 6 ? 'selected' : '' }}>Semestral </option>
                                                    @endif
                                                </select>
                                            </div>
                                            @if(isset($aluno))
                                                <br>
                                                <label title="{{'Sim - Renova a expiração do plano de acordo com a data atual e tempo selecionado. '.
                                                                'Não - atualiza a expiração considerando a data de inicio anterior e tempo selecionado.'}}">
                                                    <b>Renovar Plano ?</b>
                                                </label>
                                                <label><input type="radio" name="renovarPlanoFunc" value="sim"> Sim</label>
                                                <label><input type="radio" name="renovarPlanoFunc" value="nao" checked> Não</label>
                                            @endif
                                        </div>
                                        <div class="col-sm">
                                            <h4><strong>FUTVÔLEI</strong></h4>
                                            <div class="col-sm">
                                                <label for="dale">Tempo de Plano</label>
                                                <select class="form-control" name="tempoPlanoFut">
                                                    @if(isset($temposDePlano['futvolei']))
                                                    <option value="1" {{ $temposDePlano['futvolei'] == 1 ? 'selected' : '' }}>Mensal</option>
                                                    <option value="3" {{ $temposDePlano['futvolei'] == 3 ? 'selected' : '' }}>Trimestral </option>
                                                    <option value="6" {{ $temposDePlano['futvolei'] == 6 ? 'selected' : '' }}>Semestral</option>
                                                    @else
                                                    <option value="1" {{ old('tempoPlanoFut') == 1 ? 'selected' : '' }}>Mensal</option>
                                                    <option value="3" {{ old('tempoPlanoFut') == 3 ? 'selected' : '' }}>Trimestral </option>
                                                    <option value="6" {{ old('tempoPlanoFut') == 6 ? 'selected' : '' }}>Semestral </option>
                                                    @endif
                                                </select>
                                            </div>
                                            @if(isset($aluno))
                                                <br>
                                                <label title="{{'Sim - Renova a expiração do plano de acordo com a data atual e tempo selecionado. '.
                                                                'Não - atualiza a expiração considerando a data de inicio anterior e tempo selecionado..'}}">
                                                    <b>Renovar Plano ?</b>
                                                </label>
                                                <label><input type="radio" name="renovarPlanoFut" value="sim"> Sim</label>
                                                <label><input type="radio" name="renovarPlanoFut" value="nao" checked> Não</label>
                                            @endif
                                        </div>
                                        <div class="col-sm">
                                            <h4><strong>Combo</strong></h4>
                                            <div class="col-sm">
                                                <label for="dale">Tempo de Plano</label>
                                                <select class="form-control" name="tempoPlanoCom">
                                                    @if(isset($temposDePlano['combo']))
                                                    <option value="1" {{ $temposDePlano['combo'] == 1 ? 'selected' : '' }}>Mensal</option>
                                                    <option value="3" {{ $temposDePlano['combo'] == 3 ? 'selected' : '' }}>Trimestral </option>
                                                    <option value="6" {{ $temposDePlano['combo'] == 6 ? 'selected' : '' }}>Semestral</option>
                                                    @else
                                                    <option value="1" {{ old('tempoPlanoCom') == 1 ? 'selected' : '' }}>Mensal</option>
                                                    <option value="3" {{ old('tempoPlanoCom') == 3 ? 'selected' : '' }}>Trimestral </option>
                                                    <option value="6" {{ old('tempoPlanoCom') == 6 ? 'selected' : '' }}>Semestral </option>
                                                    @endif
                                                </select>
                                            </div>
                                            @if(isset($aluno))
                                                <br>
                                                <label title="{{'Sim - Renova a expiração do plano de acordo com a data atual e tempo selecionado. '.
                                                                'Não - atualiza a expiração considerando a data de inicio anterior e tempo selecionado..'}}">
                                                    <b>Renovar Plano ?</b>
                                                </label>
                                                <label><input type="radio" name="renovarPlanoCom" value="sim"> Sim</label>
                                                <label><input type="radio" name="renovarPlanoCom" value="nao" checked> Não</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="card-header row">
                                        <div class="col-sm card">
                                            <div class="container-radio column">
                                                <div>
                                                    <label>
                                                        <input type="radio" name="plano_id_func" class="card-input-element" value="" {{ !isset($aluno)?'checked':'' }} />
                                                        <div class="panel panel-default card-input">
                                                            <div class="panel-heading " style="color:black"><strong>Nenhum</strong></div>
                                                            <div class="panel-body column">
                                                                <div>_</div>
                                                                <div>_</div>
                                                                <div>_</div>
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                            @foreach ($funcionais as $func)
                                            <div class="container-radio column">
                                                <div>
                                                    <label>
                                                        @if(isset($alunoPlanos))
                                                        <input type="radio" name="plano_id_func" class="card-input-element" value="{{ $func->id }}" {{ in_array($func->id, $alunoPlanos) ? 'checked' : ''}} />
                                                        @else
                                                        <input type="radio" name="plano_id_func" class="card-input-element" value="{{ $func->id }}" {{ old('plano_id_func') == $func->id ? 'checked' : '' }} />
                                                        @endif
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
                                                                <div>
                                                                    Valor trimestral: R$ {{$func->preco_trimestral}}(R${{3*$func->preco_trimestral}})
                                                                </div>
                                                                <div>
                                                                    Valor semestral: R$ {{$func->preco_semestral}}(R${{6*$func->preco_semestral}})
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
                                                        <input type="radio" name="plano_id_fut" class="card-input-element" value="" {{ !isset($aluno)?'checked':'' }} />
                                                        <div class="panel panel-default card-input">
                                                            <div class="panel-heading " style="color:black"><strong>Nenhum</strong></div>
                                                            <div class="panel-body column">
                                                                <div>_</div>
                                                                <div>_</div>
                                                                <div>_</div>
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>

                                            @foreach ($futvolei as $fut)
                                            <div class="container-radio column">
                                                <div>
                                                    <label>
                                                        @if(isset($alunoPlanos))
                                                        <input type="radio" name="plano_id_fut" class="card-input-element" value="{{ $fut->id }}" {{ in_array($fut->id, $alunoPlanos) ? 'checked' : ''}} />
                                                        @else
                                                        <input type="radio" name="plano_id_fut" class="card-input-element" value="{{ $fut->id }}" {{ old('plano_id_fut') == $fut->id ? 'checked' : '' }} />
                                                        @endif
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
                                                                <div>
                                                                    Valor trimestral: R$ {{$fut->preco_trimestral}}(R${{3*$fut->preco_trimestral}})
                                                                </div>
                                                                <div>
                                                                    Valor semestral: R$ {{$fut->preco_semestral}}(R${{6*$fut->preco_semestral}})
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
                                                        <input type="radio" name="plano_id_com" class="card-input-element" value="" {{ !isset($aluno)?'checked':'' }} />
                                                        <div class="panel panel-default card-input">
                                                            <div class="panel-heading " style="color:black"><strong>Nenhum</strong></div>
                                                            <div class="panel-body column">
                                                                <div>_</div>
                                                                <div>_</div>
                                                                <div>_</div>
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>

                                            @foreach ($combos as $com)
                                            <div class="container-radio column">
                                                <div>
                                                    <label>
                                                        @if(isset($alunoPlanos))
                                                        <input type="radio" name="plano_id_com" class="card-input-element" value="{{ $com->id }}" {{ in_array($com->id, $alunoPlanos) ? 'checked' : ''}} />
                                                        @else
                                                        <input type="radio" name="plano_id_com" class="card-input-element" value="{{ $com->id }}" {{ old('plano_id_com') == $com->id ? 'checked' : '' }} />
                                                        @endif
                                                        <div class="panel panel-default card-input">
                                                            <div class="panel-heading " style="color:black"><strong>{{$com->descricao}}</strong></div>
                                                            <div class="panel-body column">
                                                                <div>
                                                                    Modalidade: Combo
                                                                </div>
                                                                <div>
                                                                    Dias na semana: {{$com->dias_semana}}
                                                                </div>
                                                                <div>
                                                                    Valor: R$ {{$com->preco}}
                                                                </div>
                                                                <div>
                                                                    Valor trimestral: R$ {{$com->preco_trimestral}}(R${{3*$com->preco_trimestral}})
                                                                </div>
                                                                <div>
                                                                    Valor semestral: R$ {{$com->preco_semestral}}(R${{6*$com->preco_semestral}})
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>

                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-11">
                                    <button type="submit" class="btn btn-primary pull-right" style="width: 140px;">SALVAR</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
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