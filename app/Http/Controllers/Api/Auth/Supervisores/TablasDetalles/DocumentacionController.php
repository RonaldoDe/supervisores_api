<?php

namespace App\Http\Controllers\Api\Auth\Supervisores\TablasDetalles;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modelos\Actividades\DocumentacionLegal;
use Illuminate\Support\Facades\DB;
use Storage;
use App\Modelos\Actividades\Detalles\Documentacion;

class DocumentacionController extends Controller
{
    public function documentacion_legal(Request $request)
     {
         //validacion de los datos de la actividad
         $validator=\Validator::make($request->all(),[
             'id_actividad' => 'required',
             'id_documento' => 'required',
             'estado_documento' => 'required',
             'nombre_sucursal' => 'required',
             'nombre_documento' => 'required',

         ]);
         if($validator->fails())
         {
           return response()->json( ['message' => $validator->errors()->all()],400);
         }

         else
         {

             
             $actividad = Documentacion::where('id_actividad', request('id_actividad'))->where('id_documento', request('id_documento'))->first();

             if($actividad!= null){
                 $img_vencido = 'documento_vencido' . time();
                 $img_renovado = 'documento_renovado' . time();
                 $url_img_renovado = str_replace(" ", "_",'documentacion_legal/'.request('nombre_sucursal').'/'.request('nombre_documento').'/'.$img_renovado);
                 $url_img_vencido = str_replace(" ", "_",'documentacion_legal/'.request('nombre_sucursal').'/'.request('nombre_documento').'/'.$img_vencido);

                 if (request('documento_vencido') != "") { // storing image in storage/app/public Folder
                    if(strpos(request('documento_vencido'), 'supervisores_api/storage/app/public/img/') == false ){
                        Storage::disk('public')->put('img/'.$url_img_vencido, base64_decode(request('documento_vencido')));
                        $actividad->documento_vencido = $url_img_vencido;
                    }
                }
                if(request('documento_renovado') != ""){
                    if(strpos(request('documento_renovado'), 'supervisores_api/storage/app/public/img') == false ){
                        Storage::disk('public')->put('img/'.$url_img_renovado, base64_decode(request('documento_renovado')));
                        $actividad->documento_renovado = $url_img_renovado;
                    }
                }
                $actividad->estado_documento = request('estado_documento');
                $actividad->observaciones = request('observaciones');
                $actividad->update();
                return response()->json(['message' => 'Documento registrado'],200);

                }
             return response()->json(['message' => 'Error Actividad no encontrada'],400);
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
            ->select('dl.id', 'dl.id_documento', 'dl.estado_documento','ldl.nombre_documento as documento')
            ->join('lista_documentacion_legal as ldl', 'dl.id_documento', 'ldl.id')
            ->where('id_actividad', request('id_actividad'))
            ->get();
            
            return response()->json($documentos, 200);
         }
    }

    public function accederAlDocumento(Request $request)
     {
         //validacion de los datos de la actividad
         $validator=\Validator::make($request->all(),[
             'id' => 'required',
             'id_actividad' => 'required',
             'id_documento' => 'required',

         ]);
         if($validator->fails())
         {
           return response()->json( ['message' => $validator->errors()->all()],400);
         }
         else
         {
            $documento = DB::table('documentacion_actividad as dl')
            ->select('dl.id', 'dl.id_documento','dl.id_actividad', 'dl.estado_documento', 'dl.documento_vencido', 'dl.documento_renovado', 'dl.observaciones','ldl.nombre_documento as documento')
            ->join('lista_documentacion_legal as ldl', 'dl.id_documento', 'ldl.id')
            ->where('dl.id_actividad', request('id_actividad'))
            ->where('dl.id', request('id'))
            ->where('dl.id_documento', request('id_documento'))
            ->first();
            
            return response()->json($documento, 200);
         }
    }
}
