@extends('layouts.app', ['activePage' => 'table', 'titlePage' => __('Listagem dos Alunos')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Listagem dos Alunos</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary" >
                                    <th>
                                        CPF
                                    </th>
                                    <th>
                                        Nome
                                    </th>
                                    <th>
                                        Telefone
                                    </th>
                                    <th>
                                        Data de Pagamento
                                    </th>
                                    </thead>
                                    <tbody>
                                    @foreach($alunos as $aluno)
                                    <tr>
                                        <td>
                                            {{ $aluno->cpf }}
                                        </td>
                                        <td>
                                            {{ $aluno->nome }}
                                        </td>
                                        <td>
                                            {{ $aluno->telefone }}
                                        </td>
                                        <td>
                                            {{ $aluno->data_cadastro }}
                                        </td>
{{--                                        <td class="text-primary">--}}
{{--                                            $36,738--}}
{{--                                        </td>--}}
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
@endsection