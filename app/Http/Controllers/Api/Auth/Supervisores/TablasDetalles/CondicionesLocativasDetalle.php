<?php

namespace App\Http\Controllers\Api\Auth\Supervisores\TablasDetalles;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;
use Illuminate\Support\Facades\DB;
use App\Modelos\Actividades\Detalles\CondicionesDetalle;

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

             $actividad = CondicionesDetalle::where('id_actividad', request('id_actividad'))->where('id_condicion', request('id_condicion'))->first();

             if($actividad!= null){
                $img_evidencia = 'foto_condicion' . time();
                $url_img = str_replace(" ", "_",'condiciones_locativas/'.request('nombre_sucursal').'/'.request('nombre_condicion').'/'.$img_evidencia);

                 if (request('foto_condicion') != "") { // storing image in storage/app/public Folder
                    if(strpos(request('foto_condicion'), 'supervisores_api/storage/app/public/img/') == false ){
                        Storage::disk('public')->put('img/'.$url_img, base64_decode(request('foto_condicion')));
                        $actividad->foto_condicion = $url_img;
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
            $condiciones_locativas = DB::table('condiciones_locativas_actividad as cl')
            ->select('cl.id', 'cl.id_condicion', 'lcl.condicion_locativa', 'cl.estado_condicion', 'cl.foto')
            ->join('lista_condiciones_locativas as lcl', 'cl.id_condicion', 'lcl.id')
            ->where('id_actividad', request('id_actividad'))
            ->get();
            
            return response()->json($condiciones_locativas, 200);
         }
    }

    public function accederCondicion(Request $request)
     {
         //validacion de los datos de la actividad
         $validator=\Validator::make($request->all(),[
             'id' => 'required',
             'id_actividad' => 'required',
             'id_condicion' => 'required',

         ]);
         if($validator->fails())
         {
           return response()->json( ['message' => $validator->errors()->all()],400);
         }
         else
         {
            $condicion = DB::table('condiciones_locativas_actividad as cl')
            ->select('cl.id', 'cl.id_actividad','cl.id_condicion', 'cl.estado_condicion', 'cl.foto_condicion', 'cl.observaciones','lcl.condicion_locativa')
            ->join('lista_condiciones_locativas as lcl', 'cl.id_condicion', 'lcl.id')
            ->where('cl.id_actividad', request('id_actividad'))
            ->where('cl.id', request('id'))
            ->where('cl.id_condicion', request('id_condicion'))
            ->first();
            
            return response()->json($condicion, 200);
         }
    }
}
