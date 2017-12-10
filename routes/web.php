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

Route::group(['prefix'=>'admin','middleware'=>'auth'],function () {
    Route::resource('clientes','ClientesController');
    Route::resource('categorias','CategoriasController');
    Route::resource('proveedores','ProveedoresController');
    Route::resource('productos','ProductosController');
    Route::resource('cupones','CuponesController');
    Route::resource('clientecupones','ClienteCuponesController');
    Route::resource('detalleordenes','DetalleOrdenesController');

    Route::get('categorias/{id}/destroy', ['uses' => "CategoriasController@destroy", 'as' => 'categorias.destroy']);
    Route::get('proveedores/{id}/destroy', ['uses' => "ProveedoresController@destroy", 'as' => 'proveedores.destroy']);
    Route::get('clientes/{id}/destroy', ['uses' => "ClientesController@destroy", 'as' => 'clientes.destroy']);
    Route::get('productos/{id}/destroy', ['uses' => "ProductosController@destroy", 'as' => 'productos.destroy']);
    Route::get('cupones/{id}/destroy', ['uses' => "CuponesController@destroy", 'as' => 'cupones.destroy']);
    Route::get('clientecupones/{id}/destroy', ['uses' => "ClienteCuponesController@destroy", 'as' => 'clientecupones.destroy']);
});


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('api')->group(function ()
{
    Route::get('/cupon/{id}', 'ClienteCuponesController@show');
    //Route::post('/valcliente', 'ClientesController@val');
    Route::get('/perfil/{id}', 'ClientesController@perfil');
    //Route::post('/users/insert', 'ClientesController@insert');
    //Route::put('/users/update/{id}', 'ClientesController@update');
    Route::get('/estado', 'EstadosController@servicio_index');
    Route::get('/estado/pais/{id}', 'EstadosController@show');
    Route::get('/ciudad', 'CiudadesController@servicio_index');
    Route::get('/ciudad/estado/{id}', 'CiudadesController@show');
    Route::get('/pais', 'PaisesController@servicio_index');

    Route::get('categorias', 'CategoriasController@servicio_index');
    Route::get('proveedor', 'ProveedoresController@servicio_index');
    Route::get('cliente', 'ClientesController@servicio_index');
    Route::get('producto', 'ProductosController@servicio_index');
    Route::get('cupon', 'CuponesController@servicio_index');
    Route::get('clientecupon', 'ClienteCuponesController@servicio_index');
});