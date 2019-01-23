<?php

namespace App\Http\Controllers\Api\Auth\Supervisores\TablasDetalles;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CondicionesLocativasDetalle extends Controller
{
    public function condicionesLocativas(Request $request)
     {
         $validator=\Validator::make($request->all(),[
             'id_actividad' => 'required',
             'id_condicion' => 'required',
             'estado_condicion' => 'required',
             'nombre_sucursal' => 'required',
             'nombre_condicion' => 'required',
             'foto_condicion' => 'required',
         ]);
         if($validator->fails())
         {
           return response()->json( ['message' => $validator->errors()->all()],400);
         }

         else
         {

             //actualizacion de la actividad por el supervisor
             $actividad = DB::table('condiciones_locativas_actividad')
             ->where('id_actividad', request('id_actividad'))
             ->where('id_condicion', request('id_condicion'))
             ->first();
             if($actividad!= null){
                 $img_evidencia = 'foto_condicion' . time();
                 

                 if (request('foto_condicion') != "") { // storing image in storage/app/public Folder
                    if(strpos(request('foto_condicion'), 'supervisores_api/storage/app/public/img/') == false ){
                        Storage::disk('public')->put('img/condiciones_locativas/'.request('nombre_sucursal').'/'.request('nombre_condicion').'/'.$img_vencido, base64_decode(request('foto_condicion')));
                        $actividad->foto_condicion = $img_evidencia;
                    }
                }
                $actividad->estado_condicion = request('estado_condicion');
                $actividad->observaciones = request('observaciones');
                $actividad->update();
                return response()->json(['message' => 'Condcion locativa registrada']);

                }
             return response()->json(['message' => 'Error Actividad no encontrada']);
         }
     }

     public function listarCondicionesLocativas(Request $request)
     {
         //validacion de los datos de la actividad
         $validator=\Validator::make($request->all(),[
             'id_actividad' => 'required',

         ]);
         if($validator->fails())
         {
           return response()->json( ['message' => $validator->errors()->all()],400);
         }
         else
         {
            $condiciones_locativas = DB::table('condiciones_locativas_actividad')
            ->where('id_actividad', request('id_actividad'))
            ->get();
            
            return response()->json($condiciones_locativas, 200);
         }
    }
}
