@extends('layouts.app', ['activePage' => 'inicio', 'titlePage' => __('Inicio')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">Inicio</h4>
                    </div>
                    <div class="card-body" style="min-height: 35em;">
    
                        @if(session('erro'))
                        <div class="alert alert-danger">{{ session('erro') }}</div>
                        @elseif(session('sucesso'))
                        <div class="alert alert-success">{{ session('sucesso') }}</div>
                        @endif

                        <form action="{{ route('buscarAluno') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <span class="bmd-form-group">
                                        <input name="cpfAluno" type="text" class="form-control" id="cpfmask" placeholder="Insira o cpf do aluno" value="">
                                        <script type="text/javascript">
                                                $('#cpfmask').mask('000.000.000-00');
                                        </script>
                                    </span>
                                </div>
                                <div class="col-md-auto">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        Buscar
                                        <div class="ripple-container"></div>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <br>
                        @if(isset($aluno))
                        <div class="row">
                            <div class="col-lg-auto">
                                <span class="bmd-form-group"><label>Nome: </label></span>
                            </div>
                            <div class="col-lg-auto">
                                <span class="bmd-form-group">{{ $aluno->nome }}</span>
                            </div>
                            <div class="col-lg-auto">
                                <span class="bmd-form-group"><label>CPF: </label></span>
                            </div>
                            <div class="col-lg-auto">
                                <span class="bmd-form-group">{{ $aluno->cpf }}</span>
                            </div>
                        </div>
                        <br>
                        <label for="">Planos Ativos </label>
                        <form action="{{ route('registrarPresenca') }}" method="post">
                            @csrf
                            <input type="hidden" name="aluno_id" value="{{ $aluno->id }}">
                            <table class="table">
                                <tbody>
                                    @foreach($planos as $plano)
                                    <tr>
                                        <td>
                                            <input type="radio" style="zoom: 200%;" name="plano_id" value="{{ $plano->id }}">
                                        </td>
                                        <td>
                                            <div class="col-lg-auto">
                                                <div class="card card-stats">
                                                    <div class="card-header">
                                                        <div class="card-icon">
                                                            <b>{{ strtoupper($plano->categoria()->tipo) }}</b>
                                                        </div>
                                                        <h5 class="card-title">
                                                            <p>
                                                                <span style="margin-right: 10em;">
                                                                    {{ $plano->dias_semana }} dia(s) por semana
                                                                </span>
                                                                <span class="{{ ($plano->dias_semana - $presencas[$plano->id]) > 0 ? 'text-success' : 'text-danger' }}">
                                                                    {{ $plano->dias_semana - $presencas[$plano->id] }} dia(s) restante(s) esta semana
                                                                </span>
                                                            </p>
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary btn-sm">Registrar Presença</button>
                            </div>
                        </form>
                        @endif
                        <br>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">Registro de presenças Hoje</h4>
                    </div>
                    <div class="card-body" style="min-height: 30em;">
                        <table class="table">
                            <thead>
                                <th>Plano / Categoria</th>
                                <th>Aluno</th>
                                <th>Entrada em</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach($presencasHoje as $presenca)
                                    <tr>
                                        <td>{{ $presenca->plano()->descricao }} / {{ $presenca->plano()->categoria()->tipo }}</td>
                                        <td>{{ $presenca->aluno()->nome ?? '' }}</td>
                                        <td>{{ $presenca->created_at->format('H:i:s d-m-Y') }}</td>
                                        <td>
                                            <form action="{{ route('presenca.delete', $presenca->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-link btn-danger" onclick="return confirm('Você tem certeza?')">
                                                    <i class=" material-icons">delete</i>
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
@endsection