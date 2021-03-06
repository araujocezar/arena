<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (auth()->guest()) {
        return redirect()->route('login');
    } else {
        return redirect()->route('inicio', ['activePage' => 'inicio']);
    }
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Route::group(['middleware' => 'auth'], function () {
    // rotas de aluno
    Route::get('/listagem-alunos/{categoria}', 'AlunoController@listarAlunos')->name('listagem-alunos');
    Route::post('/listagem-alunos/{categoria}', 'AlunoController@filtrar_aluno_cpf')->name('listagem-alunos');
    Route::delete('/remover/alunos/{categoria}/{id}', 'AlunoController@destroy')->name('aluno.destroy');
    Route::get('/cadastro-aluno', 'AlunoController@criar_aluno')->name('cadastro-aluno');
    Route::post('/cadastro-aluno/save', 'AlunoController@save')->name('aluno.save');
    Route::get('/editar-aluno/{id}', 'AlunoController@editar')->name('aluno.editar');
    Route::put('/update-aluno/{id}', 'AlunoController@atualizarAluno')->name('aluno.update');
    Route::group(['middleware' => 'adm'], function () {
    // rotas de plano
        Route::get('/listagem-planos', 'PlanoController@listar_plano')->name('listagem-planos');
        Route::get('/cadastro-plano', 'PlanoController@criar_plano')->name('cadastro-plano');
        Route::delete('/remover/planos/{id}', 'PlanoController@destroy')->name('plano.destroy');
        Route::get('/editar/planos/{id}', 'PlanoController@edit')->name('plano.edit');
        Route::post('/cadastro-plano', 'PlanoController@save')->name('plano.save');
        Route::put('/update-plano/{id}', 'PlanoController@atualizar')->name('plano.atualizar');
        Route::get('/relatorios', 'RelatorioController@index')->name('relatorios.index');
    });
    // rotas de aluguel de quadra
    Route::get('/listagem-aluguel', 'AluguelController@listar_aluguel')->name('listagem-aluguel');
    Route::post('/listagem-aluguel', 'AluguelController@filtrar_aluguel_cpf')->name('listagem-aluguel');
    Route::delete('/remover/{id}', 'AluguelController@destroy')->name('aluguel.destroy');
    Route::post('/cadastro-aluguel', 'AluguelController@save')->name('aluguel.save');

    // Rotas de relatorio


    //Rotas de tela inicial
    Route::get('/inicio', 'AlunoController@inicio')->name('inicio');
    Route::post('/inicio', 'AlunoController@buscarAluno')->name('buscarAluno');
    Route::post('/inicio/registrarPresenca', 'AlunoController@registrarPresenca')->name('registrarPresenca');
    //Rotas presenca aluno
    Route::delete('/presenca/{id}', 'AlunoController@deletarPresenca')->name('presenca.delete');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('table-list', function () {
        return view('pages.table_list');
    })->name('table');
});

Route::group(['middleware' => 'auth'], function () {
    Route::resource('user', 'UserController', ['except' => ['show']]);
    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/erro', function (){
    return view('error404');
 });
 