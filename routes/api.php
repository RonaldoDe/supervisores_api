<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//Route::post('register', 'Api\Auth\RegisterController@register');
Route::post('login', 'Api\Auth\LoginController@login');
//Route::post('loginMovil', 'Api\Auth\Supervisores\LoginSupervisoresController@login');
//Route::post('refresh', 'Api\Auth\LoginController@refresh');

//ruta protegidad por el middleware y Auth
Route::middleware(['auth:api', 'coordinadores'])->group(function () {
    Route::post('logout', 'Api\Auth\LoginController@logout');//controlador de cerrar cesion
    Route::get('dashboard', 'Api\DashboardWebController@index');//valida el tipo de usuario que se autentifica
    Route::get('HomeCoordinador', 'Api\Auth\Coordinador\HomeCoordinadorController@index');
    Route::post('crearUser', 'Api\Auth\Administrador\CrearUsuariosController@register');
    Route::get('MostrarRoles', 'Api\Auth\Administrador\CrearUsuariosController@MostrarRol');
    Route::post('CrearSupervisoresCord', 'Api\Auth\Coordinador\HomeCoordinadorController@CrearSupervisores');
    Route::get('sucursalesZona/{id}', 'Api\Auth\Coordinador\HomeCoordinadorController@mostrarPuntosVentasIdZona');
    Route::post('crearZonas', 'Api\Auth\Coordinador\ZonasCordinadorController@CrearZonas');
    Route::get('MostrarPrioridad', 'Api\Auth\Coordinador\Actividades\CrearActividadParaPlanTrabajo@MostrarTablaPrioridad');
    Route::get('MostrarFrecuencia', 'Api\Auth\Coordinador\Actividades\CrearActividadParaPlanTrabajo@MostrarTablafrecuencia');

});
//rutas moviles
Route::middleware(['auth:api', 'supervisores'])->group(function(){
    Route::get('homeSupervisor', 'Api\Auth\Supervisores\HomeSupervisorController@index');//valida el tipo de usuario que se autentifica
});

Route::post('CrearActividadApertura', 'Api\Auth\Coordinador\Actividades\CrearActividadParaPlanTrabajo@crearActividadApertura');


