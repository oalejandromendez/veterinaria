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
Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');
// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.in');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');


/*
// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
*/
// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
Route::get('/home', 'HomeController@index')->name('admin.home');

Route::middleware(['auth'])->group(function () {
    //Usuarios
    Route::resource('admin/usuarios', 'UserController', ['as' => 'admin'])->except([
        'show'
    ]);
    Route::get('admin/usuarios/data', array('as' => 'admin.usuarios.data', 'uses' => 'UserController@data'));
    Route::get('admin/usuario/perfil', array('as' => 'admin.usuario.perfil', 'uses' => 'UserController@perfil'));
    Route::post('admin/usuario/perfil', array(
        'as' => 'admin.usuario.modificar_perfil',
        'uses' => 'UserController@modificarPerfil'
    ));
    //Gestionar Tipo de respuesta
    Route::resource('animales', 'AnimalController', ['as' => 'admin']);
    Route::get('animales/data/data', array('as' => 'admin.animales.data', 'uses' => 'AnimalController@data'));

    //Gestionar Tipo de respuesta
    Route::resource('responsables', 'ResponsableController', ['as' => 'admin']);
    Route::get('responsables/data/data', array('as' => 'admin.responsables.data', 'uses' => 'ResponsableController@data'));

    //Gestionar Tipo de respuesta
    Route::resource('epicrisis', 'EpicrisisController', ['as' => 'admin']);
    Route::get('epicrisis/data/data', array('as' => 'admin.epicrisis.data', 'uses' => 'EpicrisisController@data'));

    //Gestionar Tipo de respuesta
    Route::resource('estados', 'EstadosController', ['as' => 'admin']);
    Route::get('estados/data/data', array('as' => 'admin.estados.data', 'uses' => 'EstadosController@data'));

    //Graficas
    Route::get('admin/hospitalizacion', array(
        'as' => 'admin.graficas.index',
        'uses' => 'GraficasController@index'
    ));

    //informes de Encuestas
    Route::get('informes', array(
        'as' => 'admin.informes.index',
        'uses' => 'ReportesController@index'
    ));

    Route::get('informes/datos', array(
        'as' => 'admin.informes.datos',
        'uses' => 'ReportesController@obtenerDatos'
    ));

    //filtros informes encuestas
    Route::post('informes/filtrar', array(
        'as' => 'admin.informes.filtrar',
        'uses' => 'ReportesController@filtro'
    ));



    //informes de Encuestas
    Route::get('informes_altas', array(
        'as' => 'admin.informes_altas.index',
        'uses' => 'ReportesAltasController@index'
    ));

    Route::get('informes_altas/datos', array(
        'as' => 'admin.informes_altas.datos',
        'uses' => 'ReportesAltasController@obtenerDatos'
    ));

    //filtros informes encuestas
    Route::post('informes_altas/filtrar', array(
        'as' => 'admin.informes_altas.filtrar',
        'uses' => 'ReportesAltasController@filtro'
    ));

    //Reportes pdf documentos de autoevaluacion
    Route::post('informes_decesos/descargar', array(
        'as' => 'admin.informes_decesos.descargar',
        'uses' => 'ReportesController@pdf_documento'
    ));
});