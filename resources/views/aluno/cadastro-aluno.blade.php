@extends('layouts.app', ['activePage' => 'cadastro-aluno', 'titlePage' => __('Cadastro de Aluno')])

@section('content')
<body>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">Cadastro de Aluno</h4>
                    </div>
                    <div class="card-body">
                        
                        @if(session('erro'))
                        <div class="alert alert-danger">{{ session('erro') }}</div>
                        @elseif(session('sucesso'))
                        <div class="alert alert-success">{{ session('sucesso') }}</div>
                        @endif

                        <form action="{{ route('aluno.save') }}" method="post" autocomplete="on" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            <div style="padding: 48px;">
                                <div class="form-column">
                                    <div class="form-row">
                                        <div class="col-5">
                                            <label for="nome">Nome</label>
                                            <input type="text" id="nome" name="nome" class="form-control" required>
                                        </div>
                                        <div class="col-5" style="margin-left: 48px;">
                                            <label for="cpf">CPF</label>
                                            <input type="text" minlength="14" maxlength="14" class="form-control" id="cpfmask" name="cpf" required>
                                            <script type="text/javascript">
                                                $('#cpfmask').mask('000.000.000-00');
                                            </script>
                                        </div>
                                    </div>
                                    <div class="form-row" style="margin-top: 12px;">
                                        <div class="col-5" style="margin-top: 6px;">
                                            <label for="email">Email</label>
                                            <input type="text" id="email" name="email" class="form-control">
                                        </div>
                                        <div class="col-5" style="margin-left: 48px;">
                                            <label for="sexo">Sexo:</label>
                                            <select class="form-control" id="sexo" name="sexo">
                                                <option>Feminino</option>
                                                <option>Masculino</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row" style="margin-top: 12px;">
                                        <div class="col-5">
                                            <label for="telefone">Telefone</label>
                                            <input type="text" id="telefonemask" name="telefone" class="form-control" pattern="\([0-9]{2}\)[\s][0-9]{4}-[0-9]{4,5}" >
                                            <script type="text/javascript">
                                                $('#telefonemask').mask('(00) 0000-00009');
                                            </script>
                                        </div>
                                        <div class="col-5" style="margin-left: 40px;"><div class="container">
                                            <label for="telefone">Data do Cadastro</label>
                                            <input class="form-control" id="datepicker" type="text" required>
                                        </div>
                                        <script type="text/javascript">
                                            $('#datepicker').datepicker({  
                                                dateFormat: 'dd-mm-yy',
                                            });  
                                        </script> 
                                        </div>
                                    </div>
                                </div>
                            </div>

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
                                    <div class="container-radio column">
                                        <div>
                                            <label>
                                                <input type="radio" name="plano_id_func" class="card-input-element" value="" />
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
                                                <input type="radio" name="plano_id_func" class="card-input-element" value="{{ $func->id }}" />
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
                                            <!-- nao ta dropando -->
                                        <div class="col-sm">
                                            <label for="dale">Forma de Pagamento:</label>
                                            <select class="form-control" id="pagamento" name="pagamentoFuncional">
                                                <option>cartao</option>
                                                <option>a vista 15% de desconto</option>
                                            </select>
                                        </div>
                                </div>
                                <div class="col-sm card">
                                    <div class="container-radio column">
                                        <div>
                                            <label>
                                                <input type="radio" name="plano_id_fut" class="card-input-element" value=""/>
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
                                                <input type="radio" name="plano_id_fut" class="card-input-element" value="{{ $fut->id }}" />
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
                                    <!-- ta fazendo o drop mas ta sem back -->
                                       <div class="col-sm">
                                            <label for="dale">Forma de Pagamento:</label>
                                            <select class="form-control" id="pagamento" name="pagamentoFutvolei">
                                                <option>cartao</option>
                                                <option>a vista 15% de desconto</option>
                                            </select>
                                        </div>
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