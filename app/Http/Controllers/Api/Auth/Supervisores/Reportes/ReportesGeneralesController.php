<?php

namespace App\Http\Controllers\Api\Auth\Supervisores\Reportes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modelos\Reportes\ReporteSupervisor;

class ReportesGeneralesController extends Controller
{
    public function reporteSucursal(Request $request)
    {
        $validator=\Validator::make($request->all(),[
            'nombre_reporte' => 'required',
            'id_sucursal' => 'required',
            'nombre_sucursal' => 'required',
            'observaciones' => 'required',
            'foto' => 'required',
        ]);
        if($validator->fails())
        {
          return response()->json( ['message' => $validator->errors()->all()],400);
        }

        else
        {
            //Se recupera los datos del usuario que se ha autenticado
            $user=DB::table('users as u')->where('u.id','=',Auth::id())->first();

            $supervisor=DB::table('usuario')
            ->where('correo','=',$user->email)->first();
            
            $usuario_rol=DB::table('usuarios_roles')
            ->where('id_usuario','=',$supervisor->id_usuario)->first();

            $region = DB::table('zona')
            ->where('id_usuario_roles','=',$usuario_rol->id_usuario_roles)->first();

            $coordinador = DB::table('region')
            ->where('id_region','=',$region->id_region)->first();

            if($coordinador){

                $foto = 'imagen_reporte' . time();
                 
                $url_img = str_replace(" ", "_",'reportes/'.request('nombre_sucursal').'/'.request('nombre_reporte').'/'.$foto);

                 if (request('foto') != "") { // storing image in storage/app/public Folder
                    if(strpos(request('foto'), 'supervisores_api/storage/app/public/img/') == false ){
                        Storage::disk('public')->put('img/'.$url_img, base64_decode(request('foto')));
                        $reporte = ReporteSupervisor::create([
                            'id_supervisor' => $usuario_rol->id_usuario_roles,
                            'id_coordinador' => $coordinador->id_cordinador,
                            'id_sucursal' => request('id_sucursal'),
                            'nombre_reporte' => request('observaciones'),
                            'foto' => $url_img,
                            'estado_corregido' => 0,
                            'estado_listar' => 1,
                        ]);
                        if($reporte){
                            return respose()->json(['message' => 'Reporte realizado con exitio'], 200);
                        }
                    }
                    return respose()->json(['message' => 'Error al carar la imagen'], 400);

                }else{
                    return respose()->json(['message' => 'Error Foto no existe'], 400);
                }

               
            }else{
                return respose()->json(['message' => 'Coordinador no encontrado'], 400);
            }
            
        }
    }

}
