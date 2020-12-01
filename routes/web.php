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
    return view('welcome');
});


Route::get('/home', 'HomeController@index')->name('home');
Route::resource('clientes', 'ClienteController');// todas las rutas para el CRUD de clientes

Route::resource('equipos', 'EquipoController');// todas las rutas para el CRUD de equipos
Route::resource('marcas', 'MarcaController');// todas las rutas para el CRUD de equipos
Route::resource('tipo_equipos', 'TipoEquipoController');// todas las rutas para el CRUD de equipos
Route::resource('accesorios', 'AccesorioController');// todas las rutas para el CRUD de equipos
Route::resource('recursos', 'RecursoController');// todas las rutas para el CRUD de equipos
Route::resource('modelos', 'ModeloController');// todas las rutas para el CRUD de modelos
Route::resource('tipo_recursos', 'TipoRecursoController');// todas las rutas para el CRUD de equipos
Route::resource('medidas', 'MedidaController');// todas las rutas para el CRUD de equipos
Route::resource('marca_recursos', 'MarcaRecursoController');// todas las rutas para el CRUD de equipos
Route::resource('modelos', 'ModeloController');// todas las rutas para el CRUD de modelos
Route::resource('medidas', 'MedidaController');// todas las rutas para el CRUD de modelos
Route::resource('tipo_recursos', 'TipoRecursoController');// todas las rutas para el CRUD de Tipo Recurso
Route::resource('proveedores', 'ProveedorController');// todas las rutas para el CRUD de clientes
Route::resource('tipo_movimientos', 'TipoMovimientoController');// todas las rutas para el CRUD de Tipo Movi
Route::resource('tipo_comprobantes', 'TipoComprobanteController');// todas las rutas para el CRUD de Tipo Comp
Route::resource('movimientos', 'MovimientoController');// todas las rutas para el CRUD de Movi
Route::resource('tipo_servicios', 'TipoServicioController');// todas las rutas para el CRUD de Tipo de servicio
Route::resource('prioridades', 'PrioridadController');// todas las rutas para el CRUD de prioridades
Route::resource('estados', 'EstadoController');// todas las rutas para el CRUD de estados
Route::resource('tecnicos', 'TecnicoController');// todas las rutas para el CRUD de tecnicos
Route::resource('servicios', 'ServicioController');// todas las rutas para el CRUD de Servicio
Route::resource('informes', 'InformeServicioController');// todas las rutas para el CRUD de informe
Route::post('servicios/{servicio}/agregar_tecnico', 'ServicioController@agregar_tecnico')->name('servicios.agregar_tecnico');// todas las rutas para el CRUD de Servicio
Route::post('servicios/{servicio}/finalizar_servicio', 'ServicioController@finalizar_servicio')->name('servicios.finalizar_servicio');// todas las rutas para el CRUD de Servicio
Route::get('servicios/{servicio}/atender_servicio', 'ServicioController@atender_servicio')->name('servicios.atender_servicio');// todas las rutas para el CRUD de Servicio
Route::post('marcas_ajax', 'MarcaController@storeAjax');// para el modal
Route::get('mis_servicios', 'ServicioController@mis_servicios')->name('mis_servicios.index');
Route::get('mis_servicios/confirmar/{valor}-{informe}', 'ServicioController@atender_respuesta')->name('mis_servicios.confirmar');
Route::get('mis_servicios/show_servicio_espera/{informe}', 'ServicioController@enviar_informe')->name('show_servicio_espera');
Route::get('ver_servicio/{servicio}', 'ServicioController@ver_servicio')->name('ver_servicio');
Route::get('informes/{id}/getServicio', 'InformeServicioController@getServicio')->name('informes.getServicio');// todas las rutas para el CRUD de Servicio


Route::get('configuracion', 'ConfiguracionController@index')->name('configuracion.index');
Route::put('configuracion/update', 'ConfiguracionController@update')->name('configuracion.update');
Route::get('/equipoPDF', 'PdfController@equipoPDF')->name('equipo.pdf');


Route::get('auditoria', 'AuditoriaController@index')->name('auditoria.index');
Route::get('auditoria/equipos/{auditoria}-{id}', 'AuditoriaController@showEquipos')->name('auditoria.showEquipos');


