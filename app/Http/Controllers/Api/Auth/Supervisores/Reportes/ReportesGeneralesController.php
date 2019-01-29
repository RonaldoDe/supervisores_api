<?php

namespace App\Http\Controllers\Api\Auth\Supervisores\Reportes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modelos\Reportes\ReporteSupervisor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Storage;


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
                            return response()->json(['message' => 'Reporte realizado con exitio'], 200);
                        }
                    }
                    return response()->json(['message' => 'Error al carar la imagen'], 400);

                }else{
                    return response()->json(['message' => 'Error Foto no existe'], 400);
                }

               
            }else{
                return response()->json(['message' => 'Coordinador no encontrado'], 400);
            }
            
        }
    }

    public function generarReporeteCoordinador(Request $request)
    {
        $user=DB::table('users as u')->where('u.id','=',Auth::id())->first();
        $coordinador=DB::table('coordinadores')->where('correo','=',$user->email)->first();

        if($coordinador){
            $reporte = DB::table('reportes_supervisor as rs')
            ->select('us.nombre', 'us.apellido', 'su.nombre as nombre_sucursal', 'su.cod_sucursal', 'rs.nombre_reporte', 'rs.observaciones', 'rs.foto', 'rs.estado_corregido')
            ->join('usuario as us', 'rs.id_supervisor', 'us.id_usuario')
            ->join('sucursales as su', 'rs.id_sucursal', 'su.id_suscursal')
            ->where('rs.id_coordinador', $coordinador->id_cordinador)
            ->get();

            return response()->json($reporte, 200);
        }else{
            return response()->json('Coordinador no existe', 400);
        }
    }

}
