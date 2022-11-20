<?php
use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('login');
Route::post('/login', 'HomeController@login');

Route::get('/logout', function () {
    session()->pull('usuario_autenticado', 'default');
    return redirect()->route('login');
});

Route::resource('clientes', 'HomeController');

Route::get('/principal', 'HomeController@principal')->name('principal');
Route::get('/create', 'HomeController@create')->name('create');

Route::get('/store', 'HomeController@store')->name('store');
Route::post('/store', 'HomeController@store');

Route::get('/show/{codigo_cliente}', 'HomeController@show')->name('show');
Route::get('/edit/{codigo_cliente}', 'HomeController@edit')->name('edit');

Route::get('/update', 'HomeController@update')->name('update');
Route::post('/update', 'HomeController@update');

Route::get('/pesquisarCliente', 'HomeController@pesquisarCliente');
Route::get('/executarPesquisaCliente', 'HomeController@executarPesquisaCliente')->name('executarPesquisaCliente');;
Route::post('/executarPesquisaCliente', 'HomeController@executarPesquisaCliente');

Route::get('/ConsultaCidade/{nome}', 'HomeController@ConsultaCidade')->name('ConsultaCidade');
Route::get('/ConsultaClienteExistente/{nome}', 'HomeController@ConsultaClienteExistente')->name('ConsultaClienteExistente');