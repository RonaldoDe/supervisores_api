<?php

namespace App\Http\Controllers;

use Storage;

use Illuminate\Http\Request;
use App\Modelos\Actividades\Apertura;
use App\Modelos\Actividades\CondicionesLocativas;
use App\Modelos\Actividades\Remisiones;
use App\Modelos\Actividades\Kardex;
use App\Modelos\Actividades\LibrosFaltantes;
use App\Modelos\Actividades\LibroVencimientos;
use App\Modelos\Actividades\DocumentacionLegal;
use App\Modelos\Notificaciones;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Modelos\Actividades\ActividadPtc;
use App\Modelos\Actividades\UsoInstitucional;
use App\Modelos\Actividades\ArqueoCaja;
use App\Modelos\Actividades\Domicilio;
use App\Modelos\Actividades\EnvioCorrespondencia;
use App\Modelos\Actividades\ExamenGimed;
use App\Modelos\Actividades\EvolucionClientes;
use App\Modelos\Actividades\Exhibiciones;
use App\Modelos\Actividades\Facturacion;
use App\Modelos\Actividades\Gimed;
use App\Modelos\Actividades\InventarioMercancia;
use App\Modelos\Actividades\Julienne;
use App\Modelos\Actividades\ProgramaMercadeo;
use App\Modelos\Actividades\RelacionServiciosPublicos;
use App\Modelos\Actividades\RelacionVendedores;
use App\Modelos\Actividades\ServicioBodega;
use App\Modelos\Actividades\ProductosBonificados;

class ValidarActividadesController extends Controller
{
    //requerimiento de datos para llenar la actividad
    public function apertura($request)
    {
        //validacion de los datos de la actividad
        $validator=\Validator::make($request->all(),[
            'id_actividad' => 'required',
            'id_plan_trabajo' => 'required',
            'nombre_tabla' => 'required',
            'calificacion_pv' => 'required',
            'tiempo_actividad'=>'required',
            'tiempo_total'=>'required',
            'horario'=>'required',

        ]);
        if($validator->fails())
        {
          return response()->json( ['message' => $validator->errors()->all()],400 );
        }

        else
        {
            //actualizacion de la actividad por el supervisor
            $actividad = Apertura::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
            if($actividad!= null){
                $actividad->fecha_mod =  date('Y-m-d H:i:s');
                $actividad->observacion = request('observaciones');
                $actividad->id_estado = 2;
                $actividad->calificacion = 5;
                $actividad->calificacion_pv = request('calificacion_pv');
                $actividad->tiempo_actividad = request('tiempo_actividad');
                $actividad->tiempo_total = request('tiempo_total');
                $actividad->motivo_ausencia = request('motivo_ausencia');
                $actividad->calificacion_pv = request('calificacion_pv');
                $actividad->horario = request('horario');
                $actividad->update();

                //registro de notificacion
                if($actividad){
                    if($this->logCrearNotificaciones(request('id_plan_trabajo'), request('nombre_tabla'))){
                        return response()->json(['message' => 'Actividad realizada con exito']);
                    }else{
                        return response()->json(['message' => 'Error al generar la notificacion']);
                    }

                }
            }
            return response()->json(['message' => 'Error Actividad no encontrada']);
        }
    }

    public function arqueo_caja($request)
    {
        //validacion de los datos de la actividad
        $validator=\Validator::make($request->all(),[
            'id_actividad' => 'required',
            'id_plan_trabajo' => 'required',
            'nombre_tabla' => 'required',
            'calificacion_pv' => 'required',
            'tiempo_actividad'=>'required',
            'tiempo_total'=>'required',
            'sobrante' => 'required',
            'faltante' => 'required',
            'diferencia' => 'required',
            'gastos' => 'required',
            'base' => 'required',
        ]);
        if($validator->fails())
        {
          return response()->json( ['message' => $validator->errors()->all()],400 );
        }

        else
        {
            //actualizacion de la actividad por el supervisor
            $actividad = ArqueoCaja::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
            if($actividad!= null){
                $actividad->fecha_mod =  date('Y-m-d H:i:s');
                $actividad->observacion = request('observaciones');
                $actividad->id_estado = 2;
                $actividad->calificacion = 5;
                $actividad->calificacion_pv = request('calificacion_pv');
                $actividad->tiempo_actividad = request('tiempo_actividad');
                $actividad->tiempo_total = request('tiempo_total');
                $actividad->motivo_ausencia = request('motivo_ausencia');
                $actividad->calificacion_pv = request('calificacion_pv');
                $actividad->sobrante = request('sobrante');
                $actividad->faltante = request('faltante');
                $actividad->diferencia = request('diferencia');
                $actividad->gastos = request('gastos');
                $actividad->base = request('base');
                $actividad->update();

                //registro de notificacion
                if($actividad){
                    if($this->logCrearNotificaciones(request('id_plan_trabajo'), request('nombre_tabla'))){
                        return response()->json(['message' => 'Actividad realizada con exito']);
                    }else{
                        return response()->json(['message' => 'Error al generar la notificacion']);
                    }

                }
            }
            return response()->json(['message' => 'Error Actividad no encontrada']);
        }
    }

    public function domicilios($request)
    {
        //validacion de los datos de la actividad
        $validator=\Validator::make($request->all(),[
            'id_actividad' => 'required',
            'id_plan_trabajo' => 'required',
            'nombre_tabla' => 'required',
            'calificacion_pv' => 'required',
            'tiempo_actividad'=>'required',
            'tiempo_total'=>'required',
            'mes_anterior'=>'required',
            'venta_domicilios_proyeccion'=>'required',
            'numero_mensajeros_planta'=>'required',
            'pro_domicilio_mensajero'=>'required',
            'mes_actual'=>'required',
            'dias_transcurridos'=>'required',
        ]);
        if($validator->fails())
        {
          return response()->json( ['message' => $validator->errors()->all()],400 );
        }

        else
        {
            //actualizacion de la actividad por el supervisor
            $actividad = Domicilio::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
            if($actividad!= null){
                $actividad->fecha_mod =  date('Y-m-d H:i:s');
                $actividad->observacion = request('observaciones');
                $actividad->id_estado = 2;
                $actividad->calificacion = 5;
                $actividad->calificacion_pv = request('calificacion_pv');
                $actividad->tiempo_actividad = request('tiempo_actividad');
                $actividad->tiempo_total = request('tiempo_total');
                $actividad->motivo_ausencia = request('motivo_ausencia');
                $actividad->calificacion_pv = request('calificacion_pv');
                $actividad->mes_anterior = request('mes_anterior');
                $actividad->venta_domicilios_proyeccion = request('venta_domicilios_proyeccion');
                $actividad->numero_mensajeros_planta = request('numero_mensajeros_planta');
                $actividad->pro_domicilio_mensajero = request('pro_domicilio_mensajero');
                $actividad->mes_actual = request('mes_actual');
                $actividad->dias_transcurridos = request('dias_transcurridos');
                $actividad->update();

                //registro de notificacion
                if($actividad){
                    if($this->logCrearNotificaciones(request('id_plan_trabajo'), request('nombre_tabla'))){
                        return response()->json(['message' => 'Actividad realizada con exito']);
                    }else{
                        return response()->json(['message' => 'Error al generar la notificacion']);
                    }

                }
            }
            return response()->json(['message' => 'Error Actividad no encontrada']);
        }
    }

    public function envio_correspondencia($request)
    {
        //validacion de los datos de la actividad
        $validator=\Validator::make($request->all(),[
            'id_actividad' => 'required',
            'id_plan_trabajo' => 'required',
            'nombre_tabla' => 'required',
            'calificacion_pv' => 'required',
            'tiempo_actividad'=>'required',
            'tiempo_total'=>'required',
            'correspondencia'=>'required',
        ]);
        if($validator->fails())
        {
          return response()->json( ['message' => $validator->errors()->all()],400 );
        }

        else
        {
            //actualizacion de la actividad por el supervisor
            $actividad = EnvioCorrespondencia::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
            if($actividad!= null){
                $actividad->fecha_mod =  date('Y-m-d H:i:s');
                $actividad->observacion = request('observaciones');
                $actividad->id_estado = 2;
                $actividad->calificacion = 5;
                $actividad->calificacion_pv = request('calificacion_pv');
                $actividad->tiempo_actividad = request('tiempo_actividad');
                $actividad->tiempo_total = request('tiempo_total');
                $actividad->motivo_ausencia = request('motivo_ausencia');
                $actividad->calificacion_pv = request('calificacion_pv');
                $actividad->correspondencia = request('correspondencia');
                $actividad->update();

                //registro de notificacion
                if($actividad){
                    if($this->logCrearNotificaciones(request('id_plan_trabajo'), request('nombre_tabla'))){
                        return response()->json(['message' => 'Actividad realizada con exito']);
                    }else{
                        return response()->json(['message' => 'Error al generar la notificacion']);
                    }

                }
            }
            return response()->json(['message' => 'Error Actividad no encontrada']);
        }
    }

    public function evolucion_clientes($request)
    {
        //validacion de los datos de la actividad
        $validator=\Validator::make($request->all(),[
            'id_actividad' => 'required',
            'id_plan_trabajo' => 'required',
            'nombre_tabla' => 'required',
            'calificacion_pv' => 'required',
            'tiempo_actividad'=>'required',
            'tiempo_total'=>'required',
            'ano_anterior'=>'required',
            'ano_actual'=>'required',
            'diferencia'=>'required',
            'implementar_estrategia'=>'required',
        ]);
        if($validator->fails())
        {
          return response()->json( ['message' => $validator->errors()->all()],400 );
        }

        else
        {
            //actualizacion de la actividad por el supervisor
            $actividad = EvolucionClientes::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
            if($actividad!= null){
                $actividad->fecha_mod =  date('Y-m-d H:i:s');
                $actividad->observacion = request('observaciones');
                $actividad->id_estado = 2;
                $actividad->calificacion = 5;
                $actividad->calificacion_pv = request('calificacion_pv');
                $actividad->tiempo_actividad = request('tiempo_actividad');
                $actividad->tiempo_total = request('tiempo_total');
                $actividad->motivo_ausencia = request('motivo_ausencia');
                $actividad->ano_anterior = request('ano_anterior');
                $actividad->ano_actual = request('ano_actual');
                $actividad->diferencia = request('diferencia');
                $actividad->implementar_estrategia = request('implementar_estrategia');
                $actividad->update();

                //registro de notificacion
                if($actividad){
                    if($this->logCrearNotificaciones(request('id_plan_trabajo'), request('nombre_tabla'))){
                        return response()->json(['message' => 'Actividad realizada con exito']);
                    }else{
                        return response()->json(['message' => 'Error al generar la notificacion']);
                    }

                }
            }
            return response()->json(['message' => 'Error Actividad no encontrada']);
        }
    }

    public function examen_gimed($request)
    {
        //validacion de los datos de la actividad
        $validator=\Validator::make($request->all(),[
            'id_actividad' => 'required',
            'id_plan_trabajo' => 'required',
            'nombre_tabla' => 'required',
            'calificacion_pv' => 'required',
            'tiempo_actividad'=>'required',
            'tiempo_total'=>'required',
            'examen'=>'required',
        ]);
        if($validator->fails())
        {
          return response()->json( ['message' => $validator->errors()->all()],400 );
        }

        else
        {
            //actualizacion de la actividad por el supervisor
            $actividad = ExamenGimed::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
            if($actividad!= null){
                $actividad->fecha_mod =  date('Y-m-d H:i:s');
                $actividad->observacion = request('observaciones');
                $actividad->id_estado = 2;
                $actividad->calificacion = 5;
                $actividad->calificacion_pv = request('calificacion_pv');
                $actividad->tiempo_actividad = request('tiempo_actividad');
                $actividad->tiempo_total = request('tiempo_total');
                $actividad->motivo_ausencia = request('motivo_ausencia');
                $actividad->examen = request('examen');
                $actividad->update();

                //registro de notificacion
                if($actividad){
                    if($this->logCrearNotificaciones(request('id_plan_trabajo'), request('nombre_tabla'))){
                        return response()->json(['message' => 'Actividad realizada con exito']);
                    }else{
                        return response()->json(['message' => 'Error al generar la notificacion']);
                    }

                }
            }
            return response()->json(['message' => 'Error Actividad no encontrada']);
        }
    }

    public function exhibiciones($request)
    {
        //validacion de los datos de la actividad
        $validator=\Validator::make($request->all(),[
            'id_actividad' => 'required',
            'id_plan_trabajo' => 'required',
            'nombre_tabla' => 'required',
            'calificacion_pv' => 'required',
            'tiempo_actividad'=>'required',
            'tiempo_total'=>'required',
            'productos'=>'required',
        ]);
        if($validator->fails())
        {
          return response()->json( ['message' => $validator->errors()->all()],400 );
        }

        else
        {
            //actualizacion de la actividad por el supervisor
            $actividad = Exhibiciones::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
            if($actividad!= null){
                $actividad->fecha_mod =  date('Y-m-d H:i:s');
                $actividad->observacion = request('observaciones');
                $actividad->id_estado = 2;
                $actividad->calificacion = 5;
                $actividad->calificacion_pv = request('calificacion_pv');
                $actividad->tiempo_actividad = request('tiempo_actividad');
                $actividad->tiempo_total = request('tiempo_total');
                $actividad->motivo_ausencia = request('motivo_ausencia');
                $actividad->productos = request('productos');
                $actividad->update();

                //registro de notificacion
                if($actividad){
                    if($this->logCrearNotificaciones(request('id_plan_trabajo'), request('nombre_tabla'))){
                        return response()->json(['message' => 'Actividad realizada con exito']);
                    }else{
                        return response()->json(['message' => 'Error al generar la notificacion']);
                    }

                }
            }
            return response()->json(['message' => 'Error Actividad no encontrada']);
        }
    }

    public function facturacion($request)
    {
        //validacion de los datos de la actividad
        $validator=\Validator::make($request->all(),[
            'id_actividad' => 'required',
            'id_plan_trabajo' => 'required',
            'nombre_tabla' => 'required',
            'calificacion_pv' => 'required',
            'tiempo_actividad'=>'required',
            'tiempo_total'=>'required',
            'fecha_resolucion'=>'required',
            'numero_facturas_autorizadas'=>'required',
            'fecha_ultima_factura'=>'required',
            'numero_ultima_factura'=>'required',
        ]);
        if($validator->fails())
        {
          return response()->json( ['message' => $validator->errors()->all()],400 );
        }

        else
        {
            //actualizacion de la actividad por el supervisor
            $actividad = Facturacion::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
            if($actividad!= null){
                $actividad->fecha_mod =  date('Y-m-d H:i:s');
                $actividad->observacion = request('observaciones');
                $actividad->id_estado = 2;
                $actividad->calificacion = 5;
                $actividad->calificacion_pv = request('calificacion_pv');
                $actividad->tiempo_actividad = request('tiempo_actividad');
                $actividad->tiempo_total = request('tiempo_total');
                $actividad->motivo_ausencia = request('motivo_ausencia');
                $actividad->fecha_resolucion = request('fecha_resolucion');
                $actividad->numero_facturas_autorizadas = request('numero_facturas_autorizadas');
                $actividad->fecha_ultima_factura = request('fecha_ultima_factura');
                $actividad->numero_ultima_factura = request('numero_ultima_factura');
                $actividad->update();

                //registro de notificacion
                if($actividad){
                    if($this->logCrearNotificaciones(request('id_plan_trabajo'), request('nombre_tabla'))){
                        return response()->json(['message' => 'Actividad realizada con exito']);
                    }else{
                        return response()->json(['message' => 'Error al generar la notificacion']);
                    }

                }
            }
            return response()->json(['message' => 'Error Actividad no encontrada']);
        }
    }

    public function gimed($request)
    {
        //validacion de los datos de la actividad
        $validator=\Validator::make($request->all(),[
            'id_actividad' => 'required',
            'id_plan_trabajo' => 'required',
            'nombre_tabla' => 'required',
            'calificacion_pv' => 'required',
            'tiempo_actividad'=>'required',
            'tiempo_total'=>'required',
            'productos_cero'=>'required',
            'productos_cero_rotante_90_dias'=>'required',
            'acciones_tomadas'=>'required',
            
        ]);
        if($validator->fails())
        {
          return response()->json( ['message' => $validator->errors()->all()],400 );
        }

        else
        {
            //actualizacion de la actividad por el supervisor
            $actividad = Gimed::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
            if($actividad!= null){
                $actividad->fecha_mod =  date('Y-m-d H:i:s');
                $actividad->observacion = request('observaciones');
                $actividad->id_estado = 2;
                $actividad->calificacion = 5;
                $actividad->calificacion_pv = request('calificacion_pv');
                $actividad->tiempo_actividad = request('tiempo_actividad');
                $actividad->tiempo_total = request('tiempo_total');
                $actividad->motivo_ausencia = request('motivo_ausencia');
                $actividad->productos_cero = request('productos_cero');
                $actividad->productos_cero_rotante_90_dias = request('productos_cero_rotante_90_dias');
                $actividad->acciones_tomadas = request('acciones_tomadas');
                $actividad->update();

                //registro de notificacion
                if($actividad){
                    if($this->logCrearNotificaciones(request('id_plan_trabajo'), request('nombre_tabla'))){
                        return response()->json(['message' => 'Actividad realizada con exito']);
                    }else{
                        return response()->json(['message' => 'Error al generar la notificacion']);
                    }

                }
            }
            return response()->json(['message' => 'Error Actividad no encontrada']);
        }
    }

    public function inventario_mercancia($request)
    {
        //validacion de los datos de la actividad
        $validator=\Validator::make($request->all(),[
            'id_actividad' => 'required',
            'id_plan_trabajo' => 'required',
            'nombre_tabla' => 'required',
            'calificacion_pv' => 'required',
            'tiempo_actividad'=>'required',
            'tiempo_total'=>'required',
            'valor_actual'=>'required',
            'dias_inventario'=>'required',
            'inv_optimo'=>'required',
            'valor_dev_cierre_mes'=>'required',
            'dev_vencimiento_m_estado'=>'required',
            
        ]);
        if($validator->fails())
        {
          return response()->json( ['message' => $validator->errors()->all()],400 );
        }

        else
        {
            //actualizacion de la actividad por el supervisor
            $actividad = InventarioMercancia::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
            if($actividad!= null){
                $actividad->fecha_mod =  date('Y-m-d H:i:s');
                $actividad->observacion = request('observaciones');
                $actividad->id_estado = 2;
                $actividad->calificacion = 5;
                $actividad->calificacion_pv = request('calificacion_pv');
                $actividad->tiempo_actividad = request('tiempo_actividad');
                $actividad->tiempo_total = request('tiempo_total');
                $actividad->motivo_ausencia = request('motivo_ausencia');
                $actividad->valor_actual = request('valor_actual');
                $actividad->dias_inventario = request('dias_inventario');
                $actividad->inv_optimo = request('inv_optimo');
                $actividad->valor_dev_cierre_mes = request('valor_dev_cierre_mes');
                $actividad->dev_vencimiento_m_estado = request('dev_vencimiento_m_estado');
                $actividad->update();

                //registro de notificacion
                if($actividad){
                    if($this->logCrearNotificaciones(request('id_plan_trabajo'), request('nombre_tabla'))){
                        return response()->json(['message' => 'Actividad realizada con exito']);
                    }else{
                        return response()->json(['message' => 'Error al generar la notificacion']);
                    }

                }
            }
            return response()->json(['message' => 'Error Actividad no encontrada']);
        }
    }

    public function julienne($request)
    {
        //validacion de los datos de la actividad
        $validator=\Validator::make($request->all(),[
            'id_actividad' => 'required',
            'id_plan_trabajo' => 'required',
            'nombre_tabla' => 'required',
            'calificacion_pv' => 'required',
            'tiempo_actividad'=>'required',
            'tiempo_total'=>'required',
            'venta_mes_anterior'=>'required',
            'proyeccion_mes_actual'=>'required',
            'relacion_faltantes'=>'required',
            
        ]);
        if($validator->fails())
        {
          return response()->json( ['message' => $validator->errors()->all()],400 );
        }

        else
        {
            //actualizacion de la actividad por el supervisor
            $actividad = Julienne::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
            if($actividad!= null){
                $actividad->fecha_mod =  date('Y-m-d H:i:s');
                $actividad->observacion = request('observaciones');
                $actividad->id_estado = 2;
                $actividad->calificacion = 5;
                $actividad->calificacion_pv = request('calificacion_pv');
                $actividad->tiempo_actividad = request('tiempo_actividad');
                $actividad->tiempo_total = request('tiempo_total');
                $actividad->motivo_ausencia = request('motivo_ausencia');
                $actividad->venta_mes_anterior = request('venta_mes_anterior');
                $actividad->proyeccion_mes_actual = request('proyeccion_mes_actual');
                $actividad->relacion_faltantes = request('relacion_faltantes');
                $actividad->update();

                //registro de notificacion
                if($actividad){
                    if($this->logCrearNotificaciones(request('id_plan_trabajo'), request('nombre_tabla'))){
                        return response()->json(['message' => 'Actividad realizada con exito']);
                    }else{
                        return response()->json(['message' => 'Error al generar la notificacion']);
                    }

                }
            }
            return response()->json(['message' => 'Error Actividad no encontrada']);
        }
    }

    public function productos_bonificados($request)
    {
        //validacion de los datos de la actividad
        $validator=\Validator::make($request->all(),[
            'id_actividad' => 'required',
            'id_plan_trabajo' => 'required',
            'nombre_tabla' => 'required',
            'calificacion_pv' => 'required',
            'tiempo_actividad'=>'required',
            'tiempo_total'=>'required',
            'productos_no_rotan'=>'required',
            'proximos_vencer'=>'required',
            
        ]);
        if($validator->fails())
        {
          return response()->json( ['message' => $validator->errors()->all()],400 );
        }

        else
        {
            //actualizacion de la actividad por el supervisor
            $actividad = ProductosBonificados::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
            if($actividad!= null){
                $actividad->fecha_mod =  date('Y-m-d H:i:s');
                $actividad->observacion = request('observaciones');
                $actividad->id_estado = 2;
                $actividad->calificacion = 5;
                $actividad->calificacion_pv = request('calificacion_pv');
                $actividad->tiempo_actividad = request('tiempo_actividad');
                $actividad->tiempo_total = request('tiempo_total');
                $actividad->motivo_ausencia = request('motivo_ausencia');
                $actividad->productos_no_rotan = request('productos_no_rotan');
                $actividad->proximos_vencer = request('proximos_vencer');
                $actividad->update();

                //registro de notificacion
                if($actividad){
                    if($this->logCrearNotificaciones(request('id_plan_trabajo'), request('nombre_tabla'))){
                        return response()->json(['message' => 'Actividad realizada con exito']);
                    }else{
                        return response()->json(['message' => 'Error al generar la notificacion']);
                    }

                }
            }
            return response()->json(['message' => 'Error Actividad no encontrada']);
        }
    }

    public function programa_mercadeo($request)
    {
        //validacion de los datos de la actividad
        $validator=\Validator::make($request->all(),[
            'id_actividad' => 'required',
            'id_plan_trabajo' => 'required',
            'nombre_tabla' => 'required',
            'calificacion_pv' => 'required',
            'tiempo_actividad'=>'required',
            'tiempo_total'=>'required',
            'promociones_separata'=>'required',
            'desc_escalonados'=>'required',
            'tienda_virtual'=>'required',
            'puntos_saludables'=>'required',
            'close_up'=>'required',
            
        ]);
        if($validator->fails())
        {
          return response()->json( ['message' => $validator->errors()->all()],400 );
        }

        else
        {
            //actualizacion de la actividad por el supervisor
            $actividad = ProgramaMercadeo::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
            if($actividad!= null){
                $actividad->fecha_mod =  date('Y-m-d H:i:s');
                $actividad->observacion = request('observaciones');
                $actividad->id_estado = 2;
                $actividad->calificacion = 5;
                $actividad->calificacion_pv = request('calificacion_pv');
                $actividad->tiempo_actividad = request('tiempo_actividad');
                $actividad->tiempo_total = request('tiempo_total');
                $actividad->motivo_ausencia = request('motivo_ausencia');
                $actividad->promociones_separata = request('promociones_separata');
                $actividad->desc_escalonados = request('desc_escalonados');
                $actividad->tienda_virtual = request('tienda_virtual');
                $actividad->puntos_saludables = request('puntos_saludables');
                $actividad->close_up = request('close_up');
                $actividad->update();

                //registro de notificacion
                if($actividad){
                    if($this->logCrearNotificaciones(request('id_plan_trabajo'), request('nombre_tabla'))){
                        return response()->json(['message' => 'Actividad realizada con exito']);
                    }else{
                        return response()->json(['message' => 'Error al generar la notificacion']);
                    }

                }
            }
            return response()->json(['message' => 'Error Actividad no encontrada']);
        }
    }

    public function relacion_servicios_publicos($request)
    {
        //validacion de los datos de la actividad
        $validator=\Validator::make($request->all(),[
            'id_actividad' => 'required',
            'id_plan_trabajo' => 'required',
            'nombre_tabla' => 'required',
            'calificacion_pv' => 'required',
            'tiempo_actividad'=>'required',
            'tiempo_total'=>'required',
            'consumo'=>'required',
            
        ]);
        if($validator->fails())
        {
          return response()->json( ['message' => $validator->errors()->all()],400 );
        }

        else
        {
            //actualizacion de la actividad por el supervisor
            $actividad = RelacionServiciosPublicos::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
            if($actividad!= null){
                $actividad->fecha_mod =  date('Y-m-d H:i:s');
                $actividad->observacion = request('observaciones');
                $actividad->id_estado = 2;
                $actividad->calificacion = 5;
                $actividad->calificacion_pv = request('calificacion_pv');
                $actividad->tiempo_actividad = request('tiempo_actividad');
                $actividad->tiempo_total = request('tiempo_total');
                $actividad->motivo_ausencia = request('motivo_ausencia');
                $actividad->consumo = request('consumo');
                $actividad->update();

                //registro de notificacion
                if($actividad){
                    if($this->logCrearNotificaciones(request('id_plan_trabajo'), request('nombre_tabla'))){
                        return response()->json(['message' => 'Actividad realizada con exito']);
                    }else{
                        return response()->json(['message' => 'Error al generar la notificacion']);
                    }

                }
            }
            return response()->json(['message' => 'Error Actividad no encontrada']);
        }
    }

    public function relacion_vendedores($request)
    {
        //validacion de los datos de la actividad
        $validator=\Validator::make($request->all(),[
            'id_actividad' => 'required',
            'id_plan_trabajo' => 'required',
            'nombre_tabla' => 'required',
            'calificacion_pv' => 'required',
            'tiempo_actividad'=>'required',
            'tiempo_total'=>'required',
            'vendedores_sin_cumplir'=>'required',
            'diagnostico'=>'required',
            'aplica_proceso_ideal_venta'=>'required',
            
        ]);
        if($validator->fails())
        {
          return response()->json( ['message' => $validator->errors()->all()],400 );
        }

        else
        {
            //actualizacion de la actividad por el supervisor
            $actividad = RelacionVendedores::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
            if($actividad!= null){
                $actividad->fecha_mod =  date('Y-m-d H:i:s');
                $actividad->observacion = request('observaciones');
                $actividad->id_estado = 2;
                $actividad->calificacion = 5;
                $actividad->calificacion_pv = request('calificacion_pv');
                $actividad->tiempo_actividad = request('tiempo_actividad');
                $actividad->tiempo_total = request('tiempo_total');
                $actividad->motivo_ausencia = request('motivo_ausencia');
                $actividad->vendedores_sin_cumplir = request('vendedores_sin_cumplir');
                $actividad->diagnostico = request('diagnostico');
                $actividad->aplica_proceso_ideal_venta = request('aplica_proceso_ideal_venta');
                $actividad->update();

                //registro de notificacion
                if($actividad){
                    if($this->logCrearNotificaciones(request('id_plan_trabajo'), request('nombre_tabla'))){
                        return response()->json(['message' => 'Actividad realizada con exito']);
                    }else{
                        return response()->json(['message' => 'Error al generar la notificacion']);
                    }

                }
            }
            return response()->json(['message' => 'Error Actividad no encontrada']);
        }
    }

    public function servicio_bodega($request)
    {
        //validacion de los datos de la actividad
        $validator=\Validator::make($request->all(),[
            'id_actividad' => 'required',
            'id_plan_trabajo' => 'required',
            'nombre_tabla' => 'required',
            'calificacion_pv' => 'required',
            'tiempo_actividad'=>'required',
            'tiempo_total'=>'required',
            'valor_pedido'=>'required',
            'valor_despacho'=>'required',
            'nivel_servicio'=>'required',
            'revisa_pedidos_antes_enviarlos'=>'required',
            'utiliza_libreta_faltantes'=>'required',
            
        ]);
        if($validator->fails())
        {
          return response()->json( ['message' => $validator->errors()->all()],400 );
        }

        else
        {
            //actualizacion de la actividad por el supervisor
            $actividad = ServicioBodega::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
            if($actividad!= null){
                $actividad->fecha_mod =  date('Y-m-d H:i:s');
                $actividad->observacion = request('observaciones');
                $actividad->id_estado = 2;
                $actividad->calificacion = 5;
                $actividad->calificacion_pv = request('calificacion_pv');
                $actividad->tiempo_actividad = request('tiempo_actividad');
                $actividad->tiempo_total = request('tiempo_total');
                $actividad->motivo_ausencia = request('motivo_ausencia');
                $actividad->valor_pedido = request('valor_pedido');
                $actividad->valor_despacho = request('valor_despacho');
                $actividad->diferencia = request('valor_pedido') - request('valor_despacho');
                $actividad->nivel_servicio = request('nivel_servicio');
                $actividad->revisa_pedidos_antes_enviarlos = request('revisa_pedidos_antes_enviarlos');
                $actividad->utiliza_libreta_faltantes = request('utiliza_libreta_faltantes');
                $actividad->update();

                //registro de notificacion
                if($actividad){
                    if($this->logCrearNotificaciones(request('id_plan_trabajo'), request('nombre_tabla'))){
                        return response()->json(['message' => 'Actividad realizada con exito']);
                    }else{
                        return response()->json(['message' => 'Error al generar la notificacion']);
                    }

                }
            }
            return response()->json(['message' => 'Error Actividad no encontrada']);
        }
    }

    public function uso_institucional($request)
    {
        //validacion de los datos de la actividad
        $validator=\Validator::make($request->all(),[
            'id_actividad' => 'required',
            'id_plan_trabajo' => 'required',
            'nombre_tabla' => 'required',
            'calificacion_pv' => 'required',
            'tiempo_actividad'=>'required',
            'tiempo_total'=>'required',
            'productos'=>'required',
            
        ]);
        if($validator->fails())
        {
          return response()->json( ['message' => $validator->errors()->all()],400 );
        }

        else
        {
            //actualizacion de la actividad por el supervisor
            $actividad = UsoInstitucional::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
            if($actividad!= null){
                $actividad->fecha_mod =  date('Y-m-d H:i:s');
                $actividad->observacion = request('observaciones');
                $actividad->id_estado = 2;
                $actividad->calificacion = 5;
                $actividad->calificacion_pv = request('calificacion_pv');
                $actividad->tiempo_actividad = request('tiempo_actividad');
                $actividad->tiempo_total = request('tiempo_total');
                $actividad->motivo_ausencia = request('motivo_ausencia');
                $actividad->productos = request('productos');
                $actividad->update();

                //registro de notificacion
                if($actividad){
                    if($this->logCrearNotificaciones(request('id_plan_trabajo'), request('nombre_tabla'))){
                        return response()->json(['message' => 'Actividad realizada con exito']);
                    }else{
                        return response()->json(['message' => 'Error al generar la notificacion']);
                    }

                }
            }
            return response()->json(['message' => 'Error Actividad no encontrada']);
        }
    }

     //requerimiento de datos para la actividad
     public function condiciones_locativas($request)
     {
         //validacion de los datos de la actividad
         $validator=\Validator::make($request->all(),[
             'id_actividad' => 'required',
            'nombre_tabla' => 'required',
            'id_plan_trabajo' => 'required',
            'calificacion_pv' => 'required',
            'tiempo_actividad'=>'required',
            'tiempo_total'=>'required',

         ]);
         if($validator->fails())
         {
           return response()->json( ['message' => $validator->errors()->all()],400 );
         }

         else
         {

             //actualizacion de la actividad por el supervisor
             $actividad = CondicionesLocativas::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
             if($actividad!= null){
                 $actividad->fecha_mod = date('Y-m-d H:i:s');
                 $actividad->observacion = request('observaciones');
                 $actividad->id_estado = 2;
                 $actividad->calificacion = 5;
                 $actividad->calificacion_pv = request('calificacion_pv');
                 $actividad->tiempo_actividad = request('tiempo_actividad');
                $actividad->tiempo_total = request('tiempo_total');
                $actividad->motivo_ausencia = request('motivo_ausencia');
                $actividad->update();
                 //registro de notificacion
                if($actividad){
                    if($this->logCrearNotificaciones(request('id_plan_trabajo'), request('nombre_tabla'))){
                        return response()->json(['message' => 'Actividad realizada con exito']);
                    }else{
                        return response()->json(['message' => 'Error al generar la notificacion']);
                    }
                }
             }
             return response()->json(['message' => 'Error Actividad no encontrada']);
         }
     }

     //requerimiento de datos para la actividad
     public function kardex($request)
     {
         //validacion de los datos de la actividad
         $validator=\Validator::make($request->all(),[
            'id_actividad' => 'required',
            'nombre_tabla' => 'required',
            'id_plan_trabajo' => 'required',
            'calificacion_pv' => 'required',
            'laboratorios_realizados' => 'required',
            'tiempo_actividad'=>'required',
            'tiempo_total'=>'required',
         ]);
         if($validator->fails())
         {
           return response()->json( ['message' => $validator->errors()->all()],400 );
         }

         else
         {

             //actualizacion de la actividad por el supervisor
             $actividad = Kardex::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
             if($actividad!= null){
                 $actividad->fecha_mod = date('Y-m-d H:i:s');
                 $actividad->observacion = request('observaciones');
                 $actividad->id_estado = 2;
                 $actividad->calificacion = 5;
                 $actividad->calificacion_pv = request('calificacion_pv');
                 $actividad->tiempo_actividad = request('tiempo_actividad');
                $actividad->tiempo_total = request('tiempo_total');
                $actividad->laboratorios_realizados = request('laboratorios_realizados');
                $actividad->motivo_ausencia = request('motivo_ausencia');
                $actividad->update();
                 //registro de notificacion
                 if($actividad){
                    if($this->logCrearNotificaciones(request('id_plan_trabajo'), request('nombre_tabla'))){
                        return response()->json(['message' => 'Actividad realizada con exito']);
                    }else{
                        return response()->json(['message' => 'Error al generar la notificacion']);
                    }
                }
             }
             return response()->json(['message' => 'Error Actividad no encontrada']);
         }
     }

     //requerimiento de datos para la actividad
     public function remisiones($request)
     {
         //validacion de los datos de la actividad
         $validator=\Validator::make($request->all(),[
             'id_actividad' => 'required',
             'calificacion_pv' => 'required',
             'tiempo_actividad'=>'required',
            'tiempo_total'=>'required',
            'consecutivos'=>'required',
            'numero_remisiones'=>'required',

         ]);
         if($validator->fails())
         {
           return response()->json( ['message' => $validator->errors()->all()],400 );
         }

         else
         {

             //actualizacion de la actividad por el supervisor
             $actividad = Remisiones::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
             if($actividad!= null){
                 $actividad->fecha_mod = date('Y-m-d H:i:s');
                 $actividad->observacion = request('observaciones');
                 $actividad->id_estado = 2;
                 $actividad->calificacion = 5;
                 $actividad->calificacion_pv = request('calificacion_pv');
                 $actividad->tiempo_actividad = request('tiempo_actividad');
                $actividad->tiempo_total = request('tiempo_total');
                $actividad->motivo_ausencia = request('motivo_ausencia');
                $actividad->consecutivos = request('consecutivos');
                $actividad->numero_remisiones = request('numero_remisiones');
                $actividad->update();
                 //registro de notificacion
                 if($actividad){
                    if($this->logCrearNotificaciones(request('id_plan_trabajo'), request('nombre_tabla'))){
                        return response()->json(['message' => 'Actividad realizada con exito']);
                    }else{
                        return response()->json(['message' => 'Error al generar la notificacion']);
                    }
                }
             }
             return response()->json(['message' => 'Error Actividad no encontrada']);
         }
     }

     public function libros_faltantes($request)
     {
         //validacion de los datos de la actividad
         $validator=\Validator::make($request->all(),[
             'id_actividad' => 'required',
             'calificacion_pv' => 'required',
             'productos' => 'required',
             'numero_consecutivo' => 'required',
             'tiempo_actividad'=>'required',
            'tiempo_total'=>'required',

         ]);
         if($validator->fails())
         {
           return response()->json( ['message' => $validator->errors()->all()],400 );
         }

         else
         {

             //actualizacion de la actividad por el supervisor
             $actividad = LibrosFaltantes::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
             if($actividad!= null){
                 $actividad->fecha_mod = date('Y-m-d H:i:s');
                 $actividad->observacion = request('observaciones');
                 $actividad->id_estado = 2;
                 $actividad->calificacion = 5;
                 $actividad->calificacion_pv = request('calificacion_pv');
                 $actividad->tiempo_actividad = request('tiempo_actividad');
                $actividad->tiempo_total = request('tiempo_total');
                $actividad->productos = request('productos');
                $actividad->numero_consecutivo = request('numero_consecutivo');
                $actividad->motivo_ausencia = request('motivo_ausencia');
                $actividad->update();
                 //registro de notificacion
                 if($actividad){
                    if($this->logCrearNotificaciones(request('id_plan_trabajo'), request('nombre_tabla'))){
                        return response()->json(['message' => 'Actividad realizada con exito']);
                    }else{
                        return response()->json(['message' => 'Error al generar la notificacion']);
                    }
                }
             }
             return response()->json(['message' => 'Error Actividad no encontrada']);
         }
     }

     public function libro_vencimientos($request)
     {
         //validacion de los datos de la actividad
         $validator=\Validator::make($request->all(),[
             'id_actividad' => 'required',
             'calificacion_pv' => 'required',
             'productos' => 'required',
             'tiempo_actividad'=>'required',
            'tiempo_total'=>'required',

         ]);
         if($validator->fails())
         {
           return response()->json( ['message' => $validator->errors()->all()],400 );
         }

         else
         {

             //actualizacion de la actividad por el supervisor
             $actividad = LibroVencimientos::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
             if($actividad!= null){
                 $actividad->fecha_mod = date('Y-m-d H:i:s');
                 $actividad->observacion = request('observaciones');
                 $actividad->id_estado = 2;
                 $actividad->calificacion = 5;
                 $actividad->calificacion_pv = request('calificacion_pv');
                 $actividad->tiempo_actividad = request('tiempo_actividad');
                 $actividad->productos = request('productos');
                $actividad->tiempo_total = request('tiempo_total');
                $actividad->motivo_ausencia = request('motivo_ausencia');
                $actividad->update();
                 //registro de notificacion
                 if($actividad){
                    if($this->logCrearNotificaciones(request('id_plan_trabajo'), request('nombre_tabla'))){
                        return response()->json(['message' => 'Actividad realizada con exito']);
                    }else{
                        return response()->json(['message' => 'Error al generar la notificacion']);
                    }
                }
             }
             return response()->json(['message' => 'Error Actividad no encontrada']);
         }
     }

     public function documentacion_legal($request)
     {
         //validacion de los datos de la actividad
         $validator=\Validator::make($request->all(),[
             'id_actividad' => 'required',
             'calificacion_pv' => 'required',
             'tiempo_actividad'=>'required',
            'tiempo_total'=>'required',

         ]);
         if($validator->fails())
         {
           return response()->json( ['message' => $validator->errors()->all()],400);
         }

         else
         {

             //actualizacion de la actividad por el supervisor
             $actividad = DocumentacionLegal::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
             if($actividad!= null){

                 
                 $actividad->fecha_mod = date('Y-m-d H:i:s');
                 $actividad->observacion = request('observaciones');
                 $actividad->id_estado = 2;
                 $actividad->calificacion = 5;
                 $actividad->calificacion_pv = request('calificacion_pv');
                 $actividad->tiempo_actividad = request('tiempo_actividad');
                 $actividad->tiempo_total = request('tiempo_total');
                $actividad->motivo_ausencia = request('motivo_ausencia');
                $actividad->update();
                 //registro de notificacion
                 if($actividad){
                    if($this->logCrearNotificaciones(request('id_plan_trabajo'), request('nombre_tabla'))){
                        return response()->json(['message' => 'Actividad realizada con exito']);
                    }else{
                        return response()->json(['message' => 'Error al generar la notificacion']);
                    }
                }
             }
             return response()->json(['message' => 'Error Actividad no encontrada']);
         }
     }

     public function actividades_ptc($request)
     {
         //validacion de los datos de la actividad
         $validator=\Validator::make($request->all(),[
             'id_actividad' => 'required',
             'calificacion_pv' => 'required',
             'tiempo_actividad'=>'required',
            'tiempo_total'=>'required',
            'data' => 'required',

         ]);
         if($validator->fails())
         {
           return response()->json( ['message' => $validator->errors()->all()],400);
         }

         else
         {

             //actualizacion de la actividad por el supervisor
             $actividad = ActividadPtc::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
             if($actividad!= null){
                 $actividad->fecha_mod = date('Y-m-d H:i:s');
                 $actividad->observacion = request('observaciones');
                 $actividad->id_estado = 2;
                 $actividad->calificacion = 5;
                 $actividad->calificacion_pv = request('calificacion_pv');
                 $actividad->tiempo_actividad = request('tiempo_actividad');
                 $actividad->tiempo_total = request('tiempo_total');
                $actividad->motivo_ausencia = request('motivo_ausencia');

                $array_inputs=request('data');
                $lista_inputs=json_decode($array_inputs);
                //$inputs=json_encode($lista_inputs, true);
                foreach ((array)$lista_inputs as $input) {
                    if(isset($input->tipo)){
                        if($input->tipo == 6){
                            if ($input->respuesta != "" && strlen($input->respuesta) > 200) { // storing image in storage/app/public Folder
                                $img = 'imagen_ptc_'.$actividad->titulo.'_' .$input->titulo.'_' .time();
                                $foto = str_replace(" ", "_",$img);
                                $url_img = str_replace(" ", "_",'ptc/'.request('id_plan_trabajo').'/'.$actividad->id.'/'.$foto);
                                if(strpos($input->respuesta, 'supervisores_api/storage/app/public/img/') == false ){
                                    Storage::disk('public')->put('img/'.$url_img, base64_decode($input->respuesta));
                                    $input->respuesta = $url_img;
                                }else{
                                    $input->respuesta = '';
                                }
                            }
                        }
                        
                    }
                }

                $data = json_encode($lista_inputs);
                $actividad->data = $data;
                $actividad->update();
                 //registro de notificacion
                 if($actividad){
                    if($this->logCrearNotificaciones(request('id_plan_trabajo'), request('nombre_tabla'))){
                        return response()->json(['message' => 'Actividad realizada con exito']);
                    }else{
                        return response()->json(['message' => 'Error al generar la notificacion']);
                    }
                }
             }
             return response()->json(['message' => 'Error Actividad no encontrada']);
         }
     }
}
