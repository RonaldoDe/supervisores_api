<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apertura;

class ValidarActividadesController extends Controller
{
    //requerimiento de datos para crear la finalizacion de la actividad
    public function apertura($request)
    {
        //validacion de los datos de la actividad
        $validator=\Validator::make($request->all(),[
            'id_apertura' => 'required',
            'id_plan_trabajo' => 'required',
            'fecha_inicio' => 'required|date_format:Y-m-d H:i:s',
            'fecha_fin' => 'required|date_format:Y-m-d H:i:s',
            'fecha_mod' => 'required|date_format:Y-m-d H:i:s',
            'observaciones' => 'required',
            'id_prioridad' => 'required',
            'estado' => 'required',
            'calificacion' => 'required',
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
            $actividad = Apertura::find(request('id_apertura'));
            if($actividad!= null){
                $actividad->fecha_mod = request('fecha_mod');
                $actividad->observaciones = request('observaciones');
                $actividad->estado = request('estado');
                $actividad->calificacion = request('calificacion');
                $actividad->calificacion_pv = request('calificacion_pv');
                $actividad->update();
                return response()->json(['message' => 'Actividad realizada con exito']);
            }
            return response()->json(['message' => 'Error Actividad no encontrada']);
        }
    }
}
