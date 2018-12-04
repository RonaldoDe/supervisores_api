<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modelos\Actividades\Apertura;
use App\Modelos\Actividades\CondicionesLocativas;
use App\Modelos\Actividades\PapeleriaConsignaciones;
use App\Modelos\Actividades\FormulasDespachos;
use App\Modelos\Actividades\Remisiones;
use App\Modelos\Actividades\Kardex;

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

        ]);
        if($validator->fails())
        {
          return response()->json( $errors=$validator->errors()->all() );
        }

        else
        {

            //actualizacion de la actividad por el supervisor
            $actividad = Apertura::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
            if($actividad!= null){
                $actividad->fecha_mod =  date('Y-m-d H:i:s');
                $actividad->observaciones = request('observaciones');
                $actividad->estado = 'completo';
                $actividad->calificacion = 5;
                $actividad->calificacion_pv = request('calificacion_pv');
                $actividad->update();
                return response()->json(['message' => 'Actividad realizada con exito']);
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

         ]);
         if($validator->fails())
         {
           return response()->json( $errors=$validator->errors()->all() );
         }

         else
         {

             //actualizacion de la actividad por el supervisor
             $actividad = CondicionesLocativas::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
             if($actividad!= null){
                 $actividad->fecha_mod = date('Y-m-d H:i:s');
                 $actividad->observacion = request('observaciones');
                 $actividad->estado = 'completo';
                 $actividad->calificacion = 5;
                 $actividad->calificacion_pv = request('calificacion_pv');
                 $actividad->update();
                 return response()->json(['message' => 'Actividad realizada con exito']);
             }
             return response()->json(['message' => 'Error Actividad no encontrada']);
         }
     }

     //requerimiento de datos para la actividad
     public function formulas_despachos($request)
     {
         //validacion de los datos de la actividad
         $validator=\Validator::make($request->all(),[
            'id_actividad' => 'required',
            'nombre_tabla' => 'required',
            'id_plan_trabajo' => 'required',
            'calificacion_pv' => 'required',

         ]);
         if($validator->fails())
         {
           return response()->json( $errors=$validator->errors()->all() );
         }

         else
         {

             //actualizacion de la actividad por el supervisor
             $actividad = FormulasDespachos::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
             if($actividad!= null){
                 $actividad->fecha_mod = date('Y-m-d H:i:s');
                 $actividad->observacion = request('observaciones');
                 $actividad->estado = 'completo';
                 $actividad->calificacion = 5;
                 $actividad->calificacion_pv = request('calificacion_pv');
                 $actividad->update();
                 return response()->json(['message' => 'Actividad realizada con exito']);
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

         ]);
         if($validator->fails())
         {
           return response()->json( $errors=$validator->errors()->all() );
         }

         else
         {

             //actualizacion de la actividad por el supervisor
             $actividad = Kardex::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
             if($actividad!= null){
                 $actividad->fecha_mod = date('Y-m-d H:i:s');
                 $actividad->observacion = request('observaciones');
                 $actividad->estado = 'completo';
                 $actividad->calificacion = 5;
                 $actividad->calificacion_pv = request('calificacion_pv');
                 $actividad->update();
                 return response()->json(['message' => 'Actividad realizada con exito']);
             }
             return response()->json(['message' => 'Error Actividad no encontrada']);
         }
     }

     //requerimiento de datos para la actividad
     public function papeleria_consignaciones($request)
     {
         //validacion de los datos de la actividad
         $validator=\Validator::make($request->all(),[
             'id_actividad' => 'required',
             'papeleria' => 'required',
             'valor_consignacion' => 'required',
             'valor_faltante' => 'required',
             'valor_sobrante' => 'required',
             'calificacion_pv' => 'required',

         ]);
         if($validator->fails())
         {
           return response()->json( $errors=$validator->errors()->all() );
         }

         else
         {

             //actualizacion de la actividad por el supervisor
             $actividad = PapeleriaConsignaciones::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
             if($actividad!= null){
                 $actividad->fecha_mod = date('Y-m-d H:i:s');
                 $actividad->observacion = request('observaciones');
                 $actividad->papeleria = request('papeleria');
                 $actividad->valor_consignacion = request('valor_consignacion');
                 $actividad->valor_faltante = request('valor_faltante');
                 $actividad->valor_sobrante = request('valor_sobrante');
                 $actividad->estado = 'completo';
                 $actividad->calificacion = 5;
                 $actividad->calificacion_pv = request('calificacion_pv');
                 $actividad->update();
                 return response()->json(['message' => 'Actividad realizada con exito']);
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

         ]);
         if($validator->fails())
         {
           return response()->json( $errors=$validator->errors()->all() );
         }

         else
         {

             //actualizacion de la actividad por el supervisor
             $actividad = Remisiones::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
             if($actividad!= null){
                 $actividad->fecha_mod = date('Y-m-d H:i:s');
                 $actividad->observacion = request('observaciones');
                 $actividad->estado = 'completo';
                 $actividad->calificacion = 5;
                 $actividad->calificacion_pv = request('calificacion_pv');
                 $actividad->update();
                 return response()->json(['message' => 'Actividad realizada con exito']);
             }
             return response()->json(['message' => 'Error Actividad no encontrada']);
         }
     }
}
