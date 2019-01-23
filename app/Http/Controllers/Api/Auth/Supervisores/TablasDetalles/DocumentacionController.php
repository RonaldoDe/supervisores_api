<?php

namespace App\Http\Controllers\Api\Auth\Supervisores\TablasDetalles;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modelos\Actividades\DocumentacionLegal;
use Illuminate\Support\Facades\DB;

class DocumentacionController extends Controller
{
    public function documentacion_legal(Request $request)
     {
         //validacion de los datos de la actividad
         $validator=\Validator::make($request->all(),[
             'id_actividad' => 'required',
             'id_documento' => 'required',
             'estado_documento' => 'required',
             'documento_vencido' => 'required',
             'documento_renovado' => 'required',
             'observaciones' => 'required',
             'nombre_sucursal' => 'required',
             'nombre_documento' => 'required',

         ]);
         if($validator->fails())
         {
           return response()->json( ['message' => $validator->errors()->all()],400);
         }

         else
         {

             //actualizacion de la actividad por el supervisor
             $actividad = DB::table('documentacion_actividad')
             ->where('id_actividad', request('id_actividad'))
             ->where('id_documento', request('id_documento'))
             ->first();
             if($actividad!= null){
                 $img_vencido = 'documento_vencido' . time();
                 $img_renovado = 'documento_renovado' . time();
                 

                 if (request('documento_vencido') != "" && request('documento_renovado') != "") { // storing image in storage/app/public Folder
                    if(strpos(request('documento_vencido'), 'supervisores_api/storage/app/public/img/') == false ){
                        Storage::disk('public')->put('img/documentacion_legal/'.request('nombre_sucursal').'/'.request('nombre_documento').'/'.$img_vencido, base64_decode(request('documento_vencido')));
                        $actividad->documento_vencido = 'documentacion_legal/'.request('nombre_sucursal').'/'.request('nombre_documento').'/'.$img_vencido;
                    }

                    if(strpos(request('documento_renovado'), 'supervisores_api/storage/app/public/img') == false ){
                        Storage::disk('public')->put('img/documentacion_legal/'.request('nombre_sucursal').'/'.request('nombre_documento').'/'.$img_renovado, base64_decode(request('documento_renovado')));
                        $actividad->documento_renovado = 'documentacion_legal/'.request('nombre_sucursal').'/'.request('nombre_documento').'/'.$img_renovado;
                    }
                }
                $actividad->estado_documento = request('estado_documento');
                $actividad->observaciones = request('observaciones');
                $actividad->update();
                return response()->json(['message' => 'Documento registrado']);

                }
             return response()->json(['message' => 'Error Actividad no encontrada']);
         }
     }

     public function listarDocumentos(Request $request)
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
            $documentos = DB::table('documentacion_actividad as dl')
            ->select('dl.id', 'dl.id_documento', 'dl.estado_documento', 'dl.documento_vencido', 'dl.documento_renovado', 'dl.observaciones', 'ldl.nombre_documento as documento')
            ->join('lista_documentacion_legal as ldl', 'dl.id_documento', 'ldl.id')
            ->where('id_actividad', request('id_actividad'))
            ->get();
            
            return response()->json($documentos, 200);
         }
    }
}
