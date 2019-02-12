<?php

namespace App\Http\Controllers;

use Storage;

use Illuminate\Http\Request;
use App\Modelos\Actividades\Apertura;
use App\Modelos\Actividades\CondicionesLocativas;
use App\Modelos\Actividades\PapeleriaConsignaciones;
use App\Modelos\Actividades\FormulasDespachos;
use App\Modelos\Actividades\Remisiones;
use App\Modelos\Actividades\Kardex;
use App\Modelos\Actividades\CapturaClientes;
use App\Modelos\Actividades\ConvenioExhibicion;
use App\Modelos\Actividades\EvaluacionPedidos;
use App\Modelos\Actividades\Excesos;
use App\Modelos\Actividades\IngresoSucursal;
use App\Modelos\Actividades\LibroAgendasCliente;
use App\Modelos\Actividades\LibrosFaltantes;
use App\Modelos\Actividades\LibroVencimientos;
use App\Modelos\Actividades\PresupuestoPedidos;
use App\Modelos\Actividades\RevisionCompletaInventarios;
use App\Modelos\Actividades\SeguimientoVendedor;
use App\Modelos\Actividades\DocumentacionLegal;
use App\Modelos\Notificaciones;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Modelos\Actividades\ActividadPtc;
use App\Modelos\Actividades\UsoInstitucional;

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
