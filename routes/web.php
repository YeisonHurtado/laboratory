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
    return view('login.login');
});

Route::post('login', 'Auth\LoginController@login')->name('login');

Route::get('menu', 'MenuController@index')->name('menu');
Route::resource('/productos','ProductController');
Route::post('addproductos', 'ProductController@store');
Route::get('lista/productos/{code?}','ProductController@listproducts');
Route::get('name/productos/{nameproduct?}','ProductController@searchNameProduct');

Route::get('recibo/producto','ReceiptController@products');

Route::resource('/laboratorios','LaboratoryController');
Route::post('addlaboratorio','LaboratoryController@store');
Route::get('lista/laboratorios/{nombrelab?}','LaboratoryController@listLaboratories');
Route::get('laboratorio/nextid','LaboratoryController@idLaboratory');
Route::delete('remove/{code}','LaboratoryController@removeProduct');
