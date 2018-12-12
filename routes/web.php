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

Route::resource('estudiante','StudentController');
Route::resource('paciente','PatientController');
Route::resource('/productos','ProductController');
Route::resource('laboratorios','LaboratoryController');

Route::get('/', function () {
    return view('login.login');
});

Route::get('menu', 'MenuController@index')->name('menu');
Route::get('estudiante/{codigo}','StudentController@show');
Route::get('estudiante/{codigo}/pacientes/', 'StudentController@patients');
Route::get('paciente/{num}/show','PatientController@show');
Route::get('paciente/{num}/all','PatientController@index');
Route::get('lista/productos/{code?}','ProductController@listproducts');
Route::get('name/productos/{nameproduct?}','ProductController@searchNameProduct');
Route::get('orden/producto','OrderController@products');
Route::get('orden/{idOrden}/productos/','OrderController@productsOrder');
Route::get('orden/{idOrden}/informacion/','OrderController@orderFinal');
Route::get('consulta/{idConsulta}','ConsultController@allOrders');
Route::get('orden/{idOrden}','ConsultController@onlyOneOrder');
Route::get('consulta/{idConsulta}/orden/{idOrden}','ConsultController@printOrder');
Route::get('pagos/','OrderPaymentsViewController@viewIndex');
Route::get('lista/ingresos','EntryController@entryList');
Route::get('cajas', 'BoxController@boxList');
Route::get('proveedores', 'LaboratoryController@providers');
Route::get('lista/laboratorios/{nombrelab?}','LaboratoryController@listLaboratories');
Route::get('laboratorio/nextid','LaboratoryController@idLaboratory');
Route::get('recepcion/pendientes','SendController@waiting');

Route::get('dias', 'SendController@contarDias');

Route::post('login', 'Auth\LoginController@login')->name('login');
Route::post('addproductos', 'ProductController@store');
Route::post('orden','OrderController@store');
Route::post('orden/segunda','OrderController@storeSecondPayment');
Route::post('addingreso', 'EntryController@store');
Route::post('addlaboratorio','LaboratoryController@store');
Route::post('recepcion/guardar','SendController@store');


Route::patch('ingreso/{idEntry}','EntryController@update');

Route::delete('remove/{code}','LaboratoryController@removeProduct');



