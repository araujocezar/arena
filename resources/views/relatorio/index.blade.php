@extends('layouts.app', ['activePage' => 'relatorios', 'titlePage' => __('Relatorios')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button class="btn btn-outline-primary" type="button" data-toggle="collapse"
                                    data-target="#collapseAlunosPorCategoria" aria-expanded="false">
                                    Alunos Por Categoria
                                </button>
                                <button class="btn btn-outline-primary" type="button" data-toggle="collapse"
                                    data-target="#collapseRendaPorCategoria" aria-expanded="false">
                                    Renda Por Categoria
                                </button>
                                <button class="btn btn-outline-primary" type="button" data-toggle="collapse"
                                    data-target="#collapseMatriculasPorMes" aria-expanded="false">
                                    Matriculas por Mês
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="collapse" id="collapseMatriculasPorMes">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <p>Matriculas por Mês em {{date('Y')}}</p>
                                <canvas id="matriculasPorMesChart" width=".5em" height=".5em"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="collapse" id="collapseRendaPorCategoria">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <p>Renda por Categoria</p>
                                <canvas id="rendaPorCategoriaChart" width=".5em" height=".5em"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="collapse show" id="collapseAlunosPorCategoria">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <p>Alunos por Categoria</p>
                                <canvas id="alunosPorCategoriaChart" width=".5em" height=".5em"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

<script>
var ctx = document.getElementById('alunosPorCategoriaChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: <?= $categorias; ?> ,
        datasets : [{
            data: <?= $alunosPorPlano; ?> ,
            backgroundColor : [
                'rgba(55, 255, 32, 1)',
                'rgba(54, 162, 235, 1)',
            ],
            borderColor: [
                'rgb(255, 255, 255)',
                'rgb(255, 255, 255)',

            ],
            borderWidth: 2
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>

<script>
var ctx = document.getElementById('rendaPorCategoriaChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?= $categorias; ?> ,
        datasets : [{
            label: 'Renda por Categoria',
            data: <?= $rendaPorCategoria; ?> ,
            backgroundColor : [
                'rgba(54, 162, 235, 0.2)',
                'rgba(54, 162, 235, 0.2)',
            ],
            borderColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
            ],
            borderWidth: 2
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>
<script>
var ctx = document.getElementById('matriculasPorMesChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?= $meses; ?>,
        datasets : [{
            label: 'Matriculas por Mês',
            data: <?= $matriculasPorMes; ?> ,
            backgroundColor : [
                'rgba(54, 162, 235, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(54, 162, 235, 0.2)',
            ],
            borderColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
            ],
            borderWidth: 2
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>
@endpush