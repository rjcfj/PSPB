<?php

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
	return view('welcome');
});

Route::get('jobcandidatos/create', 'candidatosController@create');
Route::post('jobcandidatos/store', 'candidatosController@store');

Route::get('jobcandidatos/verify/{confirmaCode}', [
    'as' => 'confirma_path',
    'uses' => 'candidatosController@confirma'
]);

Auth::routes();

Route::group(['middleware' => ['auth']], function() {

	Route::get('/home', 'HomeController@index');

	Route::resource('usuarios','UsuarioController');

	Route::get('jobs',['as'=>'job.index','uses'=>'JobsController@index']);
	Route::get('jobs/create',['as'=>'job.create','uses'=>'JobsController@create']);
	Route::post('jobs/create',['as'=>'job.store','uses'=>'JobsController@store']);
	Route::get('jobs/{id}',['as'=>'job.show','uses'=>'JobsController@show']);
	Route::get('jobs/{id}/edit',['as'=>'job.edit','uses'=>'JobsController@edit']);
	Route::patch('jobs/{id}',['as'=>'job.update','uses'=>'JobsController@update']);
	Route::delete('jobs/{id}',['as'=>'job.destroy','uses'=>'JobsController@destroy']);

	Route::get('candidatos',['as'=>'candidato.index','uses'=>'candidatosController@index']);
	Route::get('candidatos/create',['as'=>'candidato.create','uses'=>'candidatosController@create']);
	Route::post('candidatos/create',['as'=>'candidato.store','uses'=>'candidatosController@store']);
	Route::get('candidatos/{id}',['as'=>'candidato.show','uses'=>'candidatosController@show']);
	Route::get('file/{filename}', ['as' => 'getentry', 'uses' => 'candidatosController@file']);
	Route::get('candidatos/{id}/edit',['as'=>'candidato.edit','uses'=>'candidatosController@edit']);
	Route::patch('candidatos/{id}',['as'=>'candidato.update','uses'=>'candidatosController@update']);
	Route::delete('candidatos/{id}',['as'=>'candidato.destroy','uses'=>'candidatosController@destroy']);
});
