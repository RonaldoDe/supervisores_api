<?php

namespace App\Http\Controllers\Api\Auth\GerenteReporte;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class GerenteReporteHomeController extends Controller
{
    public function homeGerenteReporte(Request $request)
    {
        $user = DB::table('users')->where('id', Auth::id())->first();
        $gerente = DB::table('usuario')->where('correo', $user->email)->first();

        if($gerente){

            $usuario_rol=DB::table('usuarios_roles')
            ->where('id_usuario','=',$gerente->id_usuario)->first();

            if($usuario_rol){
                $reporte = DB::table('reportes_supervisor as rs')
                ->select('usu.nombre', 'usu.apellido', 'su.nombre as nombre_sucursal', 'su.cod_sucursal', 'rs.nombre_reporte', 'rs.observaciones', 'rs.foto', 'rs.estado_corregido', 'rs.id as id_reporte')
                ->join('usuarios_roles as us', 'rs.id_supervisor', 'us.id_usuario_roles')
                ->join('usuario as usu', 'us.id_usuario', 'usu.id_usuario')
                ->join('sucursales as su', 'rs.id_sucursal', 'su.id_suscursal')
                ->where('rs.id_supervisor', $usuario_rol->id_usuario_roles)
                ->get();

                return response()->json($reporte, 200);
            }else{
            return response()->json('Supervisor no existe', 400);
        }
        }else{
            return response()->json("Usuario no encontrado", 400);
        }
    }
}
