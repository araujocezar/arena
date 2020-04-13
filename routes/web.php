<?php

use Illuminate\Support\Facades\Route;

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
		return redirect()->route('profile');
	}
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::get('/listagem-alunos/{categoria}', 'AlunoController@listarAlunos')->name('listagem-alunos');
Route::get('/cadastro-aluno', function () {
	return view('aluno.cadastro-aluno');
})->name('cadastro-aluno');
Route::get('/inicio', function () {
	return view('aluno.inicio');
})->name('inicio');
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
