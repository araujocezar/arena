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
                    <div class="card-body">
                        <form>
                            <div class="form-row">
                                <div class="col">
                                    <input type="text" class="form-control" placeholder="Nome">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" placeholder="Sobrenome">
                                </div>
                            </div>
                        </form>
                        <div>
                            <button type="submit" class="btn btn-primary">SALVAR</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection