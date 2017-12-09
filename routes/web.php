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
    return view('principal.index');
});

//Web Services
Route::get('admin/categorias/servicio_index', 'CategoriasController@servicio_index');
Route::get('admin/proveedores/servicio_index', 'ProveedoresController@servicio_index');
Route::get('admin/clientes/servicio_index', 'ClientesController@servicio_index');
Route::get('admin/productos/servicio_index', 'ProductosController@servicio_index');
Route::get('admin/cupones/servicio_index', 'CuponesController@servicio_index');

Route::post('/valcliente', 'ClientesController@val');
Route::get('/perfil/{id}', 'ClientesController@perfil');

Route::group(['prefix'=>'admin','middleware'=>'auth'],function () {
    Route::resource('clientes','ClientesController');
    Route::resource('categorias','CategoriasController');
    Route::resource('proveedores','ProveedoresController');
    Route::resource('productos','ProductosController');
    Route::resource('cupones','CuponesController');
    Route::resource('clientecupones','ClienteCuponesController');

    Route::get('categorias/{id}/destroy', ['uses' => "CategoriasController@destroy", 'as' => 'categorias.destroy']);
    Route::get('proveedores/{id}/destroy', ['uses' => "ProveedoresController@destroy", 'as' => 'proveedores.destroy']);
    Route::get('clientes/{id}/destroy', ['uses' => "ClientesController@destroy", 'as' => 'clientes.destroy']);
    Route::get('productos/{id}/destroy', ['uses' => "ProductosController@destroy", 'as' => 'productos.destroy']);
    Route::get('cupones/{id}/destroy', ['uses' => "CuponesController@destroy", 'as' => 'cupones.destroy']);
    Route::get('clientecupones/{id}/destroy', ['uses' => "ClienteCuponesController@destroy", 'as' => 'clientecupones.destroy']);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
