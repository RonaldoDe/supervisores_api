<?php

namespace App\Http\Controllers\Api\Auth\Administrador\Reporte;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ReporteController extends Controller
{
    public function generarReporeteAdmin(Request $request)
    {
        $user=DB::table('users as u')->where('u.id','=',Auth::id())->first();

            $reporte = DB::table('reportes_supervisor as rs')
            ->select('usu.nombre', 'usu.apellido', 'su.nombre as nombre_sucursal', 'su.cod_sucursal', 'rs.nombre_reporte', 'rs.observaciones', 'rs.foto', 'rs.estado_corregido', 'rs.id as id_reporte', 'id_categoria')
            ->join('usuarios_roles as us', 'rs.id_supervisor', 'us.id_usuario')
            ->join('usuario as usu', 'us.id_usuario', 'usu.id_usuario')
            ->join('sucursales as su', 'rs.id_sucursal', 'su.id_suscursal')
            ->get();

            return response()->json($reporte, 200);

    }

    public function detalleReporteSucursalAdmin(Request $request)
    {
        $validator=\Validator::make($request->all(),[
            'id_reporte' => 'required',
        ]);
        if($validator->fails())
        {
          return response()->json( ['message' => $validator->errors()->all()],400);
        }

        else
        {

                $reporte = DB::table('reportes_supervisor as rs')
                ->select('us.nombre', 'us.apellido', 'su.nombre as nombre_sucursal', 'su.cod_sucursal', 'rs.nombre_reporte', 'rs.observaciones', 'rs.foto', 'rs.estado_corregido', 'rs.id as id_reporte', 'id_categoria')
                ->join('usuario as us', 'rs.id_supervisor', 'us.id_usuario')
                ->join('sucursales as su', 'rs.id_sucursal', 'su.id_suscursal')
                ->where('rs.id', request('id_reporte'))
                ->first();
                
                $mensajes = DB::table('mensaje_reporte as mr')
                ->where('mr.id_reporte', request('id_reporte'))
                ->get();
                if($reporte){
                    return response()->json(['detalle' => $reporte, 'mensajes' => $mensajes], 200);
                }else{
                    return response()->json(['message' => 'Reporte no encontado o no pertenece a sus sucursales'], 400);
                }
                 
        }
            
        
    }
}
