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




Route::post('login', 'Api\Auth\LoginController@login');
//Route::post('loginMovil', 'Api\Auth\Supervisores\LoginSupervisoresController@login');
//Route::post('refresh', 'Api\Auth\LoginController@refresh');
//ruta protegidad por el middleware y Auth donde iran todos los controladores en geneal para los usuarios
Route::middleware('auth:api')->group(function () {
Route::post('logout', 'Api\Auth\LoginController@logout');//controlador de cerrar cesion
//Route::get('dashboard', 'Api\DashboardWebController@index');//valida el tipo de usuario que se autentifica
});

//rutas coordinadores
    Route::middleware(['auth:api','coordinadores'])->group(function(){
    Route::get('HomeCoordinador', 'Api\Auth\Coordinador\HomeCoordinadorController@index');
    Route::post('CrearPlanTrabajo', 'Api\Auth\Coordinador\CrearPlanesTrabajoController@crearPlanTrabajo');
    Route::post('CrearSupervisoresCord', 'Api\Auth\Coordinador\HomeCoordinadorController@CrearSupervisores');
    Route::get('sucursalesZona/{id}', 'Api\Auth\Coordinador\HomeCoordinadorController@mostrarPuntosVentasIdZona');
    Route::post('crearZonas', 'Api\Auth\Coordinador\ZonasCordinadorController@CrearZonas');
    Route::post('CrearSucursales', 'Api\Auth\Coordinador\ZonasCordinadorController@crearSucursales');
    Route::get('MostrarPrioridad', 'Api\Auth\Coordinador\Actividades\CrearActividadParaPlanTrabajo@MostrarTablaPrioridad');
   // Route::get('MostrarFrecuencia', 'Api\Auth\Coordinador\Actividades\CrearActividadParaPlanTrabajo@MostrarTablafrecuencia');
    Route::get('devolverSupervisoresSinAsignar', 'Api\Auth\Coordinador\ZonasCordinadorController@DevolverUsuariosSupervisores');
    //Actividades
    Route::post('CrearActividadApertura', 'Api\Auth\Coordinador\Actividades\CrearActividadParaPlanTrabajo@crearActividadApertura');
    Route::post('CrearActividadDocumentacionLegal', 'Api\Auth\Coordinador\Actividades\CrearActividadParaPlanTrabajo@crearActividadDocumentacionLegal');
    Route::post('CrearActividadPapeleriaConsignaciones', 'Api\Auth\Coordinador\Actividades\CrearActividadParaPlanTrabajo@crearActividadPapeleriaConsignaciones');
    Route::post('CrearActividadFormulasDespachos', 'Api\Auth\Coordinador\Actividades\CrearActividadParaPlanTrabajo@crearActividadFormulaDespachos');
    Route::post('CrearActividadRemisiones', 'Api\Auth\Coordinador\Actividades\CrearActividadParaPlanTrabajo@crearActividadRemisiones');
    Route::post('CrearActividadKardex', 'Api\Auth\Coordinador\Actividades\CrearActividadParaPlanTrabajo2@crearActividadAKardex');
    Route::post('CrearActividadCondicionesLocativas', 'Api\Auth\Coordinador\Actividades\CrearActividadParaPlanTrabajo2@crearActividadCondicionesLocativas');
    Route::post('InsercionTablaActividad', 'Api\Auth\Coordinador\Actividades\InsercionTablaActividad@insertarTablasAactividad');
});

//rutas para un Administrador
    Route::middleware(['auth:api','administrador'])->group(function(){
    Route::post('crearUser', 'Api\Auth\Administrador\CrearUsuariosController@register');
    //devuelve los coordinadores no asignado para asignaezelo a una region
    Route::get('devolverCoordinadoresSinAsignar', 'Api\Auth\Administrador\CrearUsuariosController@devolverCordinadorNoAsigando');
    Route::get('MostrarRoles', 'Api\Auth\Administrador\CrearUsuariosController@MostrarRol');
    Route::post('crearRegion', 'Api\Auth\Administrador\CrearUsuariosController@crearRegion');

});

//rutas para un Supervisor
Route::middleware(['auth:api','supervisores'])->group(function(){
    //Vista de inicio para los supervisores
    Route::get('homeSupervisor', 'Api\Auth\Supervisores\HomeSupervisorController@index');
    //ruta de envio de datos para las actividades
    Route::post('actividad', 'Api\Auth\Supervisores\ActividadesController@index');
});





