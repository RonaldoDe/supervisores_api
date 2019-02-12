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
            'general' => 'required',
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
                $actividad->general = request('general');
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
                $actividad->ano_anterior = request('calificacion_pv');
                $actividad->ano_actual = request('correspondencia');
                $actividad->diferencia = request('correspondencia');
                $actividad->implementar_estrategia = request('correspondencia');
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
