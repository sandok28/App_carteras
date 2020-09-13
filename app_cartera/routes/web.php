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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::resource('empresas','EmpresaController');
Route::get('/empresas/desactivar/{empresa}', 'EmpresaController@desActivarEmpresa')->name('empresas.desActivarEmpresa');
Route::get('/empresas/activar/{empresa}', 'EmpresaController@activarEmpresa')->name('empresas.activarEmpresa');


Route::resource('carteras','CarterasController');
Route::get('/carteras/desactivar/{cartera}', 'CarterasController@desActivarCartera')->name('carteras.desActivarCartera');
Route::get('/carteras/activar/{cartera}', 'CarterasController@activarCartera')->name('carteras.activarCartera');