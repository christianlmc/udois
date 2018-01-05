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

Auth::routes();


Route::group(['as'=>'navbar-custom-name', 'middleware'=>'auth'], function(){
	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/perfil','UsuarioController@index')->name('perfil');
	Route::put('/perfil','UsuarioController@atualizarPerfil')->name('perfil');
	Route::get('/cria-pagina', 'PaginaController@index')->name('cria página')->middleware('admin');
});


Route::get('storage/{folder}/{filename}','ArquivoController@showProfiles')->middleware('auth');