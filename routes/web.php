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
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {
    
    Route::get('/Parametros', 'ParamController@index')->name('user.parametros');
    Route::post('/Parametros', 'ParamController@store')->name('user.salvar.parametros');

    Route::get('/Plano', 'PlanoCOntroller@index')->name('plano.inicio');
    Route::get('/Plano/Adicionar', 'PlanoCOntroller@create')->name('plano.adicionar');
    Route::post('/Plano/Adicionar', 'PlanoCOntroller@store')->name('plano.salvar');
    Route::get('/Plano/Envio/{plano} ', 'PlanoCOntroller@pagseguro_send')->name('plano.enviar');

    

});
