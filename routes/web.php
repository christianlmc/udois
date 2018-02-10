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

Route::get('/', 'WelcomeController@index');

Auth::routes();


Route::group(['middleware'=>'auth'], function(){
	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/perfil','UsuarioController@index');
	Route::put('/perfil','UsuarioController@update');

	Route::get('/sala/{id}', 'MensagemController@index');
	Route::get('/sala/{id}/mensagem/{mensagem_id}', 'MensagemController@loadMore');
	Route::post('/sala/{id}', 'MensagemController@create');
	Route::put('/sala/{id}', 'MensagemController@update');

	Route::group(['middleware'=>'admin'], function(){
		Route::get('/sala/criar/{usuario_id}', 'HomeController@adminCreate');
		Route::get('/cria-pagina', 'PaginaController@index');
		Route::get('/lista-pagina', 'PaginaController@list');
		Route::get('/lista-pagina/{id}', 'PaginaController@get');
		Route::post('/cria-pagina', 'PaginaController@create');
		Route::put('/lista-pagina', 'PaginaController@edit');
		Route::delete('/lista-pagina', 'PaginaController@delete');
	});
});

Route::get('/pagina/{url}', 'PaginaController@single');
Route::get('storage/banners/{filename}','ArquivoController@showBanner');
Route::get('storage/profiles/{filename}','ArquivoController@showProfile');
Route::get('storage/download/{sala_id}/{filename}','ArquivoController@downloadFile');