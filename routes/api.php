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
//Route::post('refresh', 'Api\Auth\LoginController@refresh');
//ruta protegidad por el middleware y Auth donde iran todos los controladores en geneal para los usuarios
Route::middleware('auth:api')->group(function () {
    Route::post('logout', 'Api\Auth\LoginController@logout');//controlador de cerrar cesion
    Route::post('nombrePlan', 'Api\Auth\Coordinador\CrearPlanesTrabajoController@ActualizarNombrePlanTrabajo');
});

//colcoar las validaciones del array por fechas base de datos esta en plantrabajoactividad3
//rutas coordinadores

Route::middleware(['auth:api','coordinadores'])->group(function(){
    //listado de rutas y nombre de actividades
    Route::get('rutas', 'Api\Auth\Supervisores\DescripcionActividadController@rutas');

    //ver reportes de sucursales
    Route::get('reporteSucursal', 'Api\Auth\Supervisores\Reportes\ReportesGeneralesController@generarReporeteCoordinador');
    Route::post('mensajeReporte', 'Api\Auth\Supervisores\Reportes\ReportesGeneralesController@crearMensageReporte');

    Route::post('multiActividades', 'Api\Auth\Coordinador\Actividades\GenerarMultiActividadesController@generarMultiActividades');
    
    //listado de actvidades
    Route::post('viewActividades', 'Api\Auth\Coordinador\PlanesController@allActividades');

    //plan asigancion
    Route::post('asignarPlan', 'Api\Auth\Coordinador\PlanesController@asignarEstadoPlan');

    //estadisticas y reporte
    Route::get('allInformation', 'Api\Auth\Coordinador\Reporte\AllInformationController@alInformation');

    //log de notificaciones al realizar una actividad
    Route::get('logNotificaciones', 'Api\Auth\Coordinador\Reporte\LogController@logNotificaciones');
    Route::post('notificacionLeida', 'Api\Auth\Coordinador\Reporte\LogController@notificacionLeida');
    Route::post('notificacionNoLeida', 'Api\Auth\Coordinador\Reporte\LogController@notificacionNoLeida');
    //busqueda de laboratorios
    Route::post('searchLaboratorio', 'Api\Auth\Coordinador\BuscadoresController@searchLaboratories');

    Route::post('listaDocumentos', 'Api\Auth\Supervisores\TablasDetalles\DocumentacionController@listarDocumentosCoordinador');
    Route::post('listaCondiciones', 'Api\Auth\Supervisores\TablasDetalles\CondicionesLocativasDetalle@listarCondicionesLocativas');


    //se agregaron estos para ps repores segir mirando
    //rutas de actualizar actividades
    Route::post('updateApertura', 'Api\Auth\Coordinador\Actividades\UpdateActividadesController@updateActividadApertura');
    Route::post('updateDocumentacionLegal', 'Api\Auth\Coordinador\Actividades\UpdateActividadesController@updateActividadDocumentacionLegal');
    Route::post('updatePapeleriaConsignaciones', 'Api\Auth\Coordinador\Actividades\UpdateActividadesController@updateActividadPapeleriaConsignaciones');
    Route::post('updateFormulasDespachos', 'Api\Auth\Coordinador\Actividades\UpdateActividadesController@updateActividadFormulaDespachos');
    Route::post('updateCondicionesLocativas', 'Api\Auth\Coordinador\Actividades\UpdateActividadesController@updateActividadCondicionesLocativas');
    Route::post('updateRemisiones', 'Api\Auth\Coordinador\Actividades\UpdateActividadesController@updateActividadRemisiones');
    Route::post('updateKardex', 'Api\Auth\Coordinador\Actividades\UpdateActividadesController@updateActividadKardex');
    Route::post('updateSeguimientoVendedor', 'Api\Auth\Coordinador\Actividades\UpdateActividadesController@updateActividadSeguimientoVendedor');
    Route::post('updateEvaluacionPedidos', 'Api\Auth\Coordinador\Actividades\UpdateActividadesController@updateActividadEvaluacionPedidos');
    Route::post('updatePresupuestoPedidos', 'Api\Auth\Coordinador\Actividades\UpdateActividadesController@updateActividadPresupuestoPedidos');
    Route::post('updateLibroFaltante', 'Api\Auth\Coordinador\Actividades\UpdateActividadesController@updateActividadLibrosFaltantes');
    Route::post('updateCapturaClientes', 'Api\Auth\Coordinador\Actividades\UpdateActividadesController@updateActividadCapturaClientes');
    Route::post('updateLibroAgendaCliente', 'Api\Auth\Coordinador\Actividades\UpdateActividadesController@updateActividadLibroAgendaCliente');
    Route::post('updateConvenioExhibicion', 'Api\Auth\Coordinador\Actividades\UpdateActividadesController@updateActividadConvenioExhibicion');
    Route::post('updateExcesos', 'Api\Auth\Coordinador\Actividades\UpdateActividadesController@updateActividadExcesos');
    Route::post('updateLibroVencimientos', 'Api\Auth\Coordinador\Actividades\UpdateActividadesController@updateActividadLibroVencimientos');
    Route::post('updateIngresoSucursal', 'Api\Auth\Coordinador\Actividades\UpdateActividadesController@updateActividadIngresoSucursal');
    Route::post('updatePtc', 'Api\Auth\Coordinador\Actividades\UpdateActividadesController@updateActividadPtc');

    //eliminar 
    //actividades
    Route::post('deleteActividad', 'Api\Auth\Coordinador\Actividades\DeleteActividadController@deleteActividad');
    //plan
    Route::post('deletePlanTrabajo', 'Api\Auth\Coordinador\PlanesController@deletePlan');
    
    Route::post('mostrarPlanes', 'Api\Auth\Coordinador\CrearPlanesTrabajoController@mostrarPlanSucursal');
    Route::post('actividades', 'Api\Auth\Coordinador\PlanesController@listarActividades');
    Route::get('reporte', 'Api\Auth\Coordinador\Reporte\ReporteController@mostrarReportePorCoordinador');
    Route::get('reporteActividad', 'Api\Auth\Coordinador\Reporte\ReporteController@mostrarActividadesPorSucursal');
    Route::get('HomeCoordinador', 'Api\Auth\Coordinador\HomeCoordinadorController@index');
    Route::post('datosSucursal', 'Api\Auth\Coordinador\HomeCoordinadorController@datosSucursal');
    Route::post('CrearPlanTrabajo', 'Api\Auth\Coordinador\CrearPlanesTrabajoController@crearPlanTrabajo');
    Route::post('CrearSupervisoresCord', 'Api\Auth\Coordinador\HomeCoordinadorController@CrearSupervisores');
    Route::get('sucursalesZona/{id}', 'Api\Auth\Coordinador\HomeCoordinadorController@mostrarPuntosVentasIdZona');
    Route::post('crearZonas', 'Api\Auth\Coordinador\ZonasCordinadorController@CrearZonas');
    Route::post('CrearSucursales', 'Api\Auth\Coordinador\ZonasCordinadorController@crearSucursales');
    Route::get('MostrarPrioridad', 'Api\Auth\Coordinador\Actividades\CrearActividadParaPlanTrabajo@MostrarTablaPrioridad');
   // Route::get('MostrarFrecuencia', 'Api\Auth\Coordinador\Actividades\CrearActividadParaPlanTrabajo@MostrarTablafrecuencia');
    Route::get('devolverSupervisoresSinAsignar', 'Api\Auth\Coordinador\ZonasCordinadorController@DevolverUsuariosSupervisores');
    //Actividades
    Route::post('InsercionTablaActividad', 'Api\Auth\Coordinador\Actividades\InsercionTablaActividad@insertarTablasAactividad');
    Route::post('CrearActividadApertura', 'Api\Auth\Coordinador\Actividades\CrearActividadParaPlanTrabajo@crearActividadApertura');
    Route::post('CrearActividadDocumentacionLegal', 'Api\Auth\Coordinador\Actividades\CrearActividadParaPlanTrabajo@crearActividadDocumentacionLegal');
    Route::post('CrearActividadPapeleriaConsignaciones', 'Api\Auth\Coordinador\Actividades\CrearActividadParaPlanTrabajo@crearActividadPapeleriaConsignaciones');
    Route::post('CrearActividadFormulasDespachos', 'Api\Auth\Coordinador\Actividades\CrearActividadParaPlanTrabajo@crearActividadFormulaDespachos');
    Route::post('CrearActividadRemisiones', 'Api\Auth\Coordinador\Actividades\CrearActividadParaPlanTrabajo@crearActividadRemisiones');
    Route::post('CrearActividadKardex', 'Api\Auth\Coordinador\Actividades\CrearActividadParaPlanTrabajo2@crearActividadAKardex');
    Route::post('CrearActividadCondicionesLocativas', 'Api\Auth\Coordinador\Actividades\CrearActividadParaPlanTrabajo@crearActividadCondicionesLocativas');
    Route::post('CrearActividadSeguimientoVendedor', 'Api\Auth\Coordinador\Actividades\CrearActividadParaPlanTrabajo2@crearActividadSeguimientoVendedor');
    Route::post('CrearActividadEvaluacionPedidos', 'Api\Auth\Coordinador\Actividades\CrearActividadParaPlanTrabajo2@crearActividadEvaluacionPedidos');
    Route::post('CrearActividadPresupuestoPedidos', 'Api\Auth\Coordinador\Actividades\CrearActividadParaPlanTrabajo2@crearActividadPresupuestoPedidos');
    Route::post('CrearActividadCapturaClientes', 'Api\Auth\Coordinador\Actividades\CrearActividadParaPlanTrabajo2@crearActividadCapturaClientes');
    Route::post('CrearActividadLibroFaltante', 'Api\Auth\Coordinador\Actividades\CrearActividadParaPlanTrabajo2@crearActividadLibrosFaltantes');
    Route::post('CrearActividadLibroAgendaCliente', 'Api\Auth\Coordinador\Actividades\CrearActividadParaPlanTrabajo3@crearActividadLibroAgendaCliente');
    Route::post('CrearActividadConvenioExhibicion', 'Api\Auth\Coordinador\Actividades\CrearActividadParaPlanTrabajo3@crearActividadConvenioExhibicion');
    Route::post('CrearActividadExcesos', 'Api\Auth\Coordinador\Actividades\CrearActividadParaPlanTrabajo3@crearActividadExcesos');
    Route::post('CrearActividadIngresoSucursal', 'Api\Auth\Coordinador\Actividades\CrearActividadParaPlanTrabajo3@crearActividadIngresoSucursal');
    Route::post('CrearActividadLibroVencimientos', 'Api\Auth\Coordinador\Actividades\CrearActividadParaPlanTrabajo3@crearActividadLibroVencimientos');
    Route::post('CrearActividadPtc', 'Api\Auth\Coordinador\Actividades\CrearActividadParaPlanTrabajo3@crearActividadPtc');
});

//rutas para un Administrador
    Route::middleware(['auth:api','administrador'])->group(function(){
    Route::post('crearUser', 'Api\Auth\Administrador\CrearUsuariosController@register');
    //devuelve los coordinadores no asignado para asignaezelo a una region
    Route::get('devolverCoordinadoresSinAsignar', 'Api\Auth\Administrador\CrearUsuariosController@devolverCordinadorNoAsigando');
    Route::get('MostrarRoles', 'Api\Auth\Administrador\CrearUsuariosController@MostrarRol');
    Route::post('crearRegion', 'Api\Auth\Administrador\CrearUsuariosController@crearRegion');

});

//cambio de contraseña
Route::post('changePass', 'Api\Auth\Supervisores\PasswordUpdateController@passwordUpdate');
Route::post('verifyPass', 'Api\Auth\Supervisores\PasswordUpdateController@verify');

//rutas para un Supervisor
Route::middleware(['auth:api','supervisores'])->group(function(){
    //Vista de inicio para los supervisores
    Route::get('homeSupervisor', 'Api\Auth\Supervisores\HomeSupervisorController@index');
    
    Route::post('searchProducts', 'Api\Auth\Coordinador\BuscadoresController@searchProducts');
    Route::post('searchLaboratories', 'Api\Auth\Coordinador\BuscadoresController@searchLaboratories');

    Route::get('actividades_completas', 'Api\Auth\Supervisores\ActividadesCompletasController@index');
    Route::get('mostrarActividades', 'Api\Auth\Supervisores\ListarActividadesController@index');
    //ruta de envio de datos para las actividades
    Route::post('actividad', 'Api\Auth\Supervisores\ActividadesController@index');

    //documentacion legal detalle
    Route::post('listarDocumentacion', 'Api\Auth\Supervisores\TablasDetalles\DocumentacionController@listarDocumentos');
    Route::post('terminarDocumento', 'Api\Auth\Supervisores\TablasDetalles\DocumentacionController@documentacion_legal');
    Route::post('accederDocumento', 'Api\Auth\Supervisores\TablasDetalles\DocumentacionController@accederAlDocumento');


    //crear reporte
    Route::get('porcentajeActividades', 'Api\Auth\Supervisores\Reportes\ReportesGeneralesController@porcentajeActividades');
    
    //listar reortes
    Route::get('obtenerReporteSucursal', 'Api\Auth\Supervisores\Reportes\ReportesGeneralesController@generarReporeteSupervisor');
    Route::post('detalleRepSucursal', 'Api\Auth\Supervisores\Reportes\ReportesGeneralesController@detalleReporteSucursal');
    Route::post('enviarMensajeReporte', 'Api\Auth\Supervisores\Reportes\ReportesGeneralesController@crearMensageReporte');

    //buscar sucursales
    Route::post('searchSucursales', 'Api\Auth\Coordinador\BuscadoresController@searchSucursales');

    //condiciones locativas detalle
    Route::post('listarCondicionesLocativas', 'Api\Auth\Supervisores\TablasDetalles\CondicionesLocativasDetalle@listarCondicionesLocativas');
    Route::post('terminarCondicionesLocativas', 'Api\Auth\Supervisores\TablasDetalles\CondicionesLocativasDetalle@condicionesLocativas');
    Route::post('accederCondicion', 'Api\Auth\Supervisores\TablasDetalles\CondicionesLocativasDetalle@accederCondicion');
    
    //ruta de las descripciones de las actividades
    Route::get('profileUser', 'Api\Auth\Supervisores\HomeSupervisorController@profileUser');
    //perfil de usuario
    Route::get('descripcionActividad', 'Api\Auth\Supervisores\DescripcionActividadController@description');
});

//rutas protegidas par ael gerente de repore encargado de realiar reporte de alguna anomalia en cualquien sucursal
Route::middleware(['auth:api','gerenteReporte'])->group(function(){
    Route::get('homeGerente', 'Api\Auth\GerenteReporte\GerenteReporteHomeController@homeGerenteReporte');
    Route::post('enviarMensajeReporteGerente', 'Api\Auth\Supervisores\Reportes\ReportesGeneralesController@crearMensageReporte');

});

//rutas compartidas
Route::middleware(['auth:api','gerenteReporte', 'supervisores'])->group(function(){
    Route::post('reporteSupervisor', 'Api\Auth\Supervisores\Reportes\ReportesGeneralesController@reporteSucursal');
});

Route::middleware(['auth:api','coordinadores', 'supervisores'])->group(function(){
    Route::post('detalleReporteSucursal', 'Api\Auth\Supervisores\Reportes\ReportesGeneralesController@detalleReporteSucursal');

});


