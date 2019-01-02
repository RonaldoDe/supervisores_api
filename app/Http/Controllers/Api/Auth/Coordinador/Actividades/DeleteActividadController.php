<?php

namespace App\Http\Controllers\Api\Auth\Coordinador\Actividades;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DeleteActividadController extends Controller
{
    public function deleteActividad(Request $request)
    {
        $validator=\Validator::make($request->all(),[
            'id_actividad' => 'required',
            'id_plan_trabajo'=>'required|numeric',
            'actividad' => 'required',


        ]);
        if($validator->fails())
        {
          return response()->json( $errors=$validator->errors()->all(),400 );
        }
        else
        {
            $actividad = DB::table(request('actividad'))
            ->where('id', request('id_actividad'))
            ->where('id_plan_trabajo', request('id_plan_trabajo'))
            ->first();
            if($actividad){
                if($actividad->estado == 'completo'){
                    return response()->json('Actividad eliminada',200);
                }else{
                    return response()->json('La actividad esta completa no puedes eliminar',400);
                }
            }else{
                return response()->json('Actividad no encontrada',400);
            }

        }
    }
}
