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
    return view('visitantes/index');
});

Route::get('/informacion', function () {
    return view('visitantes/info');
});

Route::get('/contacto', function () {
    return view('visitantes/contact');
});

Route::get('/identidad', function () {
    return view('visitantes/dse');
});

Route::get('/preguntas', function () {
    return view('visitantes/qa');
});

Route::get('/formacion', function () {
    return view('visitantes/fi');
});

Route::get('/coordinacion', function () {
    return view('visitantes/coordinacion');
});

Route::get('/autenticidad', function () {
    return view('visitantes/authenticity');
});
Route::get('/email', function () {
    return view('auth/email');
});

Route::get('admin/tutores/registro_tutorados', 'TutoradosController@index');

Auth::routes(['verify' => true]);

Route::get('admin/dashboard', 'HomeController@index')->name('admin');

Route::get('iniciar-sesion', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm'])->name('login');
Route::post('iniciar-sesion', 'Auth\LoginController@login');
Route::get('cerrar-sesion', 'Auth\LoginController@logout')->name('logout');

Route::get('auth/google', 'Auth\LoginController@redirect');
Route::get('auth/google/callback', 'Auth\LoginController@callback');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'noCache']], function() {
    Route::view('/', 'admin/dashboard');

    // Información General
    Route::view('/auth/email', 'admin/auth/email');  

    //Route::view('/inicio-sesion', 'admin/informacion/contact');
    Route::view('/contacto', 'admin/informacion/contact');
    Route::view('/identidad', 'admin/informacion/dse');
    Route::view('/formacion', 'admin/informacion/fi');
    Route::view('/informacion', 'admin/informacion/info');
    Route::view('/preguntas', 'admin/informacion/qa');
    Route::view('/tramites', 'admin/informacion/tramit');
    Route::view('/perfil/editar', 'admin/editar-perfil');
    Route::view('/perfil/cambiar', 'admin/cambiar-contrasena');

    Route::view('/auth/email', 'admin/auth/email');  



    // Tutores y Tutorados

    Route::get('/tutores/registro', 'TutoradosController@index')->name('tutorados');
    Route::get('/tutores/detalleTutor/{id}', 'TutoradosController@detalleTutor');
    Route::get('/tutores/alumnosRegistrados', 'TutoradosController@alumnosRegistrados');

    // Registro de Citas

    Route::get('/citas/citasInd', 'CitasController@indexInd');
    Route::get('/citas/citasGroup', 'CitasController@indexGroup');
    Route::get('/citas/citasIndividuales', 'CitasController@citasIndividuales');
    Route::post('/citas/citasIndividuales', 'CitasController@crearCI');
    Route::get('/citas/citasGrupales', 'CitasController@citasGrupales');
    Route::post('/citas/citasGrupales', 'CitasController@crearCG');

    // Registro de Grupos

    Route::get('/grupos/registroGrupos', 'GruposController@index');
    Route::post('/grupos/registroGrupos', 'GruposController@crearGrupo');
    Route::get('/grupos/asignarAlumnos/{id}', 'GruposController@alumnosAsignados');
    Route::post('/grupos/asignarAlumnos/{id}', 'GruposController@asignarAlumnos');
    Route::get('/grupos/detalleGrupos/{id}', 'GruposController@detallesGrupos');

});