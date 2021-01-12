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
/*Ruta a la pagina principal */
Route::get('/', 'ControladorDePaginas@home');

/* Ruta de reportes*/
Route::get('/reportecasinregistro/{extend}', 'ReporteController@CAsinRegistro')->name('reportecasinregistro');
Route::get('/reportecainactivos/{extend}', 'ReporteController@CAInactivos')->name('reportecainactivos');
Route::get('/reporteactivossa/{extend}', 'ReporteController@ActivosSA')->name('reporteactivossa');
Route::get('/reportsaestemes{extend}', 'ReporteController@SAEsteMes')->name('reportsaestemes');


/*Rutas de Almacenamiento */
Route::post('storage/create', 'StorageController@save');
Route::post('xls', 'StorageExcelController@save')->name('xls');
Route::post('/padron', 'StoragePadron@savepadron')->name('padron');

/*Ruta de CRUD o ABM */
Route::resource('unsa','ArchivoUnsaController');
Route::resource('sgap_todos','ArchivoTitularesController');
Route::resource('sgap_activos','ArchivoActivosController');
/*Crud de Reportes */
Route::resource('reportes_activos_sa','ReporteActivosSAController');
Route::resource('reportes_ca_inactivos','ReporteCAInactivosController');
Route::resource('reportes_ca_sin_registro','ReporteCASinRegistroController');
Route::resource('reportes_sa_este_mes','ReportesSAEsteMesController');

/*Ruta generica */
Route::get('{slug}','ControladorDePaginas@abrir');
