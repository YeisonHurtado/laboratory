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

Route::resource('estudiante','StudentController');
Route::get('estudiante/{codigo}','StudentController@show');
Route::get('estudiante/{codigo}/pacientes/', 'StudentController@patients');

Route::resource('paciente','PatientController');
Route::get('paciente/{num}/show','PatientController@show');
Route::get('paciente/{num}/all','PatientController@index');

Route::resource('/productos','ProductController');
Route::post('addproductos', 'ProductController@store');
Route::get('lista/productos/{code?}','ProductController@listproducts');
Route::get('name/productos/{nameproduct?}','ProductController@searchNameProduct');

Route::get('orden/producto','OrderController@products');

Route::resource('/laboratorios','LaboratoryController');
Route::post('addlaboratorio','LaboratoryController@store');
Route::get('lista/laboratorios/{nombrelab?}','LaboratoryController@listLaboratories');
Route::get('laboratorio/nextid','LaboratoryController@idLaboratory');
Route::delete('remove/{code}','LaboratoryController@removeProduct');
