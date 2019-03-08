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

    Route::get('inputsPlantilla', 'Api\Auth\Coordinador\Reporte\RutasFreeController@inputs');
    Route::get('senalizacion', 'Api\Auth\Coordinador\Reporte\RutasFreeController@senalizacion');
    Route::post('empleadosSucursal', 'Api\Auth\Coordinador\BuscadoresController@empleados_sucursal');

    Route::post('logErrors', 'Api\Auth\Log\LogErrorsController@logErrors');


    
    Route::get('profileUser', 'Api\Auth\Supervisores\HomeSupervisorController@profileUser');
    //buscar sucursales
    Route::post('searchSucursales', 'Api\Auth\Coordinador\BuscadoresController@searchSucursales');
    Route::post('soporteTecnico', 'Api\Auth\Coordinador\Reporte\ReporteController@soporteTecnico');
    Route::get('logNotificacionesUsuario', 'Api\Auth\Coordinador\Reporte\LogController@logNotificaciones');
    
    Route::post('reporteSupervisor', 'Api\Auth\Supervisores\Reportes\ReportesGeneralesController@reporteSucursal');
    Route::post('ocultarReporte', 'Api\Auth\Supervisores\Reportes\ReportesGeneralesController@hideReport');
    Route::post('detalleRepSucursal', 'Api\Auth\Supervisores\Reportes\ReportesGeneralesController@detalleReporteSucursal');
    Route::post('enviarMensajeReporte', 'Api\Auth\Supervisores\Reportes\ReportesGeneralesController@crearMensageReporte');
    Route::get('obtenerReporteSucursal', 'Api\Auth\Supervisores\Reportes\ReportesGeneralesController@generarReporeteSupervisor');
});

//colcoar las validaciones del array por fechas base de datos esta en plantrabajoactividad3
//rutas coordinadores

Route::middleware(['auth:api','coordinadores'])->group(function(){
    //listado de rutas y nombre de actividades
    Route::get('rutas', 'Api\Auth\Supervisores\DescripcionActividadController@rutas');

    Route::get('listaSupervisores', 'Api\Auth\Coordinador\Panel\PanelControlController@listaSupervisores');


    //ver reportes de sucursales
    Route::get('reporteSucursal', 'Api\Auth\Supervisores\Reportes\ReportesGeneralesController@generarReporeteCoordinador');
    Route::post('detalleReporteSucursal', 'Api\Auth\Supervisores\Reportes\ReportesGeneralesController@detalleReporteSucursal');
    Route::post('mensajeReporte', 'Api\Auth\Supervisores\Reportes\ReportesGeneralesController@crearMensageReporte');
    Route::post('corregirReporte', 'Api\Auth\Supervisores\Reportes\ReportesGeneralesController@corregirReporte');

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
    Route::post('updateApertura', 'Api\Auth\Coordinador\Actividades\UpdateActividadesController@update_apertura');
    Route::post('updateArqueoCaja', 'Api\Auth\Coordinador\Actividades\UpdateActividadesController@update_arqueo_caja');
    Route::post('updateDocumentacionLegal', 'Api\Auth\Coordinador\Actividades\UpdateActividadesController@update_documentacion_legal');
    Route::post('updateCondicionesLocativas', 'Api\Auth\Coordinador\Actividades\UpdateActividadesController@update_condiciones_locativas');
    Route::post('updateDomicilios', 'Api\Auth\Coordinador\Actividades\UpdateActividadesController@update_domicilios');
    Route::post('updateEnvioCorrespondencia', 'Api\Auth\Coordinador\Actividades\UpdateActividadesController@update_envio_correspondencia');
    Route::post('updateEvolucionClientes', 'Api\Auth\Coordinador\Actividades\UpdateActividadesController@update_evolucion_clientes');
    Route::post('updateExamenGimed', 'Api\Auth\Coordinador\Actividades\UpdateActividadesController@update_examen_gimed');
    Route::post('updateExhibiciones', 'Api\Auth\Coordinador\Actividades\UpdateActividadesController@update_exhibiciones');
    Route::post('updateFacturacion', 'Api\Auth\Coordinador\Actividades\UpdateActividadesController@update_facturacion');
    Route::post('updateGimed', 'Api\Auth\Coordinador\Actividades\UpdateActividadesController@update_gimed');
    Route::post('updateInventarioMercancia', 'Api\Auth\Coordinador\Actividades\UpdateActividadesController@update_inventario_mercancia');
    Route::post('updateJulienne', 'Api\Auth\Coordinador\Actividades\UpdateActividadesController@update_julienne');
    Route::post('updateProductosBonificados', 'Api\Auth\Coordinador\Actividades\UpdateActividadesController@update_productos_bonificados');
    Route::post('updateProgramaMercadeo', 'Api\Auth\Coordinador\Actividades\UpdateActividadesController@update_programa_mercadeo');
    Route::post('updateRelacionServiciosPublicos', 'Api\Auth\Coordinador\Actividades\UpdateActividadesController@update_relacion_servicios_publicos');
    Route::post('updateRelacionVendedores', 'Api\Auth\Coordinador\Actividades\UpdateActividadesController@update_relacion_vendedores');
    Route::post('updateRemisiones', 'Api\Auth\Coordinador\Actividades\UpdateActividadesController@update_remisiones');
    Route::post('updateRevicionCompletaInventario', 'Api\Auth\Coordinador\Actividades\UpdateActividadesController@update_revicion_completa_inventario');
    Route::post('updateKardex', 'Api\Auth\Coordinador\Actividades\UpdateActividadesController@update_kardex');
    Route::post('updateServicioBodega', 'Api\Auth\Coordinador\Actividades\UpdateActividadesController@update_servicio_bodega');
    Route::post('updateUsoInstitucional', 'Api\Auth\Coordinador\Actividades\UpdateActividadesController@update_uso_institucional');
    Route::post('updateLibroFaltante', 'Api\Auth\Coordinador\Actividades\UpdateActividadesController@update_libros_faltantes');
    Route::post('updateLibroVencimientos', 'Api\Auth\Coordinador\Actividades\UpdateActividadesController@update_libro_vencimientos');
    Route::post('updateCompromisos', 'Api\Auth\Coordinador\Actividades\UpdateActividadesController@update_compromisos');
    Route::post('updateContratosAnexos', 'Api\Auth\Coordinador\Actividades\UpdateActividadesController@update_contratos_anexos_legalizacion');
    Route::post('updateSolicitudSeguro', 'Api\Auth\Coordinador\Actividades\UpdateActividadesController@update_solicitud_seguro');
    Route::post('updateChequeoSucursal', 'Api\Auth\Coordinador\Actividades\UpdateActividadesController@update_senalizacion');
    Route::post('updatePtc', 'Api\Auth\Coordinador\Actividades\UpdateActividadesController@update_ptc');

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

    //Actividades crear
    Route::post('InsercionTablaActividad', 'Api\Auth\Coordinador\Actividades\InsercionTablaActividad@insertarTablasAactividad');
    Route::post('CrearActividadApertura', 'Api\Auth\Coordinador\Actividades\CrearActividadesPlanController@crear_apertura');
    Route::post('CrearActividadDocumentacionLegal', 'Api\Auth\Coordinador\Actividades\CrearActividadesPlanController@crear_documentacion_legal');
    Route::post('CrearActividadRemisiones', 'Api\Auth\Coordinador\Actividades\CrearActividadesPlanController@crear_remisiones');
    Route::post('CrearActividadKardex', 'Api\Auth\Coordinador\Actividades\CrearActividadesPlanController@crear_kardex');
    Route::post('CrearActividadCondicionesLocativas', 'Api\Auth\Coordinador\Actividades\CrearActividadesPlanController@crear_condiciones_locativas');
    Route::post('CrearActividadLibroVencimientos', 'Api\Auth\Coordinador\Actividades\CrearActividadesPlanController@crear_libro_vencimientos');
    Route::post('CrearActividadPtc', 'Api\Auth\Coordinador\Actividades\CrearActividadesPlanController@crear_ptc');
    Route::post('CrearActividadArqueoCaja', 'Api\Auth\Coordinador\Actividades\CrearActividadesPlanController@crear_arqueo_caja');
    Route::post('CrearActividadDomicilios', 'Api\Auth\Coordinador\Actividades\CrearActividadesPlanController@crear_domicilios');
    Route::post('CrearActividadEnvioCorrespondencia', 'Api\Auth\Coordinador\Actividades\CrearActividadesPlanController@crear_envio_correspondencia');
    Route::post('CrearActividadEvolucionClientes', 'Api\Auth\Coordinador\Actividades\CrearActividadesPlanController@crear_evolucion_clientes');
    Route::post('CrearActividadExamenGimed', 'Api\Auth\Coordinador\Actividades\CrearActividadesPlanController@crear_examen_gimed');
    Route::post('CrearActividadExhibiciones', 'Api\Auth\Coordinador\Actividades\CrearActividadesPlanController@crear_exhibiciones');
    Route::post('CrearActividadFacturacion', 'Api\Auth\Coordinador\Actividades\CrearActividadesPlanController@crear_facturacion');
    Route::post('CrearActividadGimed', 'Api\Auth\Coordinador\Actividades\CrearActividadesPlanController@crear_gimed');
    Route::post('CrearActividadInventarioMercancia', 'Api\Auth\Coordinador\Actividades\CrearActividadesPlanController@crear_inventario_mercancia');
    Route::post('CrearActividadJulienne', 'Api\Auth\Coordinador\Actividades\CrearActividadesPlanController@crear_julienne');
    Route::post('CrearActividadProductosBonificados', 'Api\Auth\Coordinador\Actividades\CrearActividadesPlanController@crear_productos_bonificados');
    Route::post('CrearActividadProgramaMercadeo', 'Api\Auth\Coordinador\Actividades\CrearActividadesPlanController@crear_programa_mercadeo');
    Route::post('CrearActividadRelacionServiciosPublicos', 'Api\Auth\Coordinador\Actividades\CrearActividadesPlanController@crear_relacion_servicios_publicos');
    Route::post('CrearActividadRelacionVendedores', 'Api\Auth\Coordinador\Actividades\CrearActividadesPlanController@crear_relacion_vendedores');
    Route::post('CrearActividadRevicionCompletaInventario', 'Api\Auth\Coordinador\Actividades\CrearActividadesPlanController@crear_revicion_completa_inventario');
    Route::post('CrearActividadServicioBodega', 'Api\Auth\Coordinador\Actividades\CrearActividadesPlanController@crear_servicio_bodega');
    Route::post('CrearActividadUsoInstitucional', 'Api\Auth\Coordinador\Actividades\CrearActividadesPlanController@crear_uso_institucional');
    Route::post('CrearActividadCompromisos', 'Api\Auth\Coordinador\Actividades\CrearActividadesPlanController@crear_compromisos');
    Route::post('CrearActividadContratosAnexos', 'Api\Auth\Coordinador\Actividades\CrearActividadesPlanController@crear_contratos_anexos_legalizacion');
    Route::post('CrearActividadSolicitudSeguro', 'Api\Auth\Coordinador\Actividades\CrearActividadesPlanController@crear_solicitud_seguro');
    Route::post('CrearActividadChequeoSucursal', 'Api\Auth\Coordinador\Actividades\CrearActividadesPlanController@crear_senalizacion');
    Route::post('CrearActividadLibroFaltante', 'Api\Auth\Coordinador\Actividades\CrearActividadesPlanController@crear_libros_faltantes');
});

//rutas para un Administrador
    Route::middleware(['auth:api','administrador'])->group(function(){
    Route::post('crearUser', 'Api\Auth\Administrador\CrearUsuariosController@register');
    //devuelve los coordinadores no asignado para asignaezelo a una region
    Route::get('devolverCoordinadoresSinAsignar', 'Api\Auth\Administrador\CrearUsuariosController@devolverCordinadorNoAsigando');
    Route::get('MostrarRoles', 'Api\Auth\Administrador\CrearUsuariosController@MostrarRol');
    Route::post('crearRegion', 'Api\Auth\Administrador\CrearUsuariosController@crearRegion');

    Route::get('homeAdmin', 'Api\Auth\Administrador\HomeController@home');
    Route::get('getSucursalsAdmin/{id}', 'Api\Auth\Administrador\HomeController@mostrarPuntosVentasIdZona');
    Route::post('datosSucursalAdmin', 'Api\Auth\Administrador\HomeController@datosSucursal');
    Route::post('viewActivitiesAdmin', 'Api\Auth\Administrador\ActividadesController@allActividades');
    Route::post('showActivitiesAdmin', 'Api\Auth\Administrador\HomeController@listarActividades');
    Route::post('listaPlanesAdmin', 'Api\Auth\Administrador\HomeController@mostrarPlanSucursal');
    Route::post('actividadesPlanAdmin', 'Api\Auth\Administrador\ActividadesController@mostrarActividadesPorPlan');
    Route::get('mostrarReporteAdmin', 'Api\Auth\Administrador\ActividadesController@mostrarReporteAdmin');


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
    Route::post('notificacionLeidaMensaje', 'Api\Auth\Coordinador\Reporte\LogController@notificacionLeida');
    

    //condiciones locativas detalle
    Route::post('listarCondicionesLocativas', 'Api\Auth\Supervisores\TablasDetalles\CondicionesLocativasDetalle@listarCondicionesLocativas');
    Route::post('terminarCondicionesLocativas', 'Api\Auth\Supervisores\TablasDetalles\CondicionesLocativasDetalle@condicionesLocativas');
    Route::post('accederCondicion', 'Api\Auth\Supervisores\TablasDetalles\CondicionesLocativasDetalle@accederCondicion');
    
    //ruta de las descripciones de las actividades
    //perfil de usuario
    Route::get('descripcionActividad', 'Api\Auth\Supervisores\DescripcionActividadController@description');


});

//rutas protegidas par ael gerente de repore encargado de realiar reporte de alguna anomalia en cualquien sucursal
Route::middleware(['auth:api','gerenteReporte'])->group(function(){
    Route::get('homeGerente', 'Api\Auth\GerenteReporte\GerenteReporteHomeController@homeGerenteReporte');

});



