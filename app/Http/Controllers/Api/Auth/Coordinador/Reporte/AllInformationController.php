<?php

namespace App\Http\Controllers\Api\Auth\Coordinador\Reporte;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AllInformationController extends Controller
{
    //toda la informacion de un coordinador
    public function alInformation(Request $request)
    {
        $user=DB::table('users as u')->where('u.id','=',Auth::id())->first();
        $coordinador=DB::table('coordinadores')->where('correo','=',$user->email)->first();

        if(!$coordinador){
            $usuario = DB::table('usuario as u')->where('u.correo','=',$user->email)->where('id_estado','=', 1)->first();
            if($usuario){
                $admin = DB::table('usuarios_roles')->where('id_usuario','=',$usuario->id_usuario)->where('id_rol', 2)->first();
                if($admin){
                    return response()->json('Usuario Administrador', 309);
                }else{
                    return response()->json('Usuario No es administrador', 400);
                }
            }else{
                return response()->json('Usuario no econtrado', 400);
            }
       }


       // Se recupera los datos del coordinador para mostrar su region y datos personales
       $region=DB::table('region as r')
                        ->join('coordinadores as c','c.id_cordinador','=','r.id_cordinador')
                        ->select('r.id_region','r.nombre as region','c.apellido','c.nombre','r.id_cordinador')
                        ->where('r.id_cordinador','=',$coordinador->id_cordinador)
                        ->first();

        //obtener zonas del coordinador
        $zonas=DB::table('zona as zo')
        ->select('zo.descripcion_zona', 'uz.id_region', 'zo.id_zona', 'uz.id_usuario')
        ->join('usuario_zona as uz','zo.id_zona','=','uz.id_zona')
        ->join('usuarios_roles as ur','uz.id_usuario','=','ur.id_usuario_roles')
        ->where('zo.id_region',$region->id_region)
        ->where('ur.id_rol', 1)
        ->get();

       $sucursales_array = array();
       $actividades_array = array();
        foreach($zonas as $zona){
            $sucursales=DB::table('sucursales as su')
            ->select('su.id_suscursal', 'su.cod_sucursal', 'su.nombre', 'su.id_zona', 'ur.id', 'u.nombre as nombre_supervisor', 'u.apellido as apellido_supervisor')
            ->join('usuario_zona as uz', 'su.id_zona', 'uz.id')
            ->join('usuarios_roles as ur', 'uz.id_usuario', 'ur.id')
            ->join('usuario as u', 'ur.id_usuario', 'u.id')
            ->where('su.id_zona',$zona->id_zona)
            ->get();
            $sucursales_array = array_add($sucursales_array, $zona->descripcion_zona, $sucursales);
        }
        $planes=DB::table('plan_trabajo_asignacion as pt')
                ->where('pt.idcoordinador',$coordinador->id_cordinador)
                ->get();
        foreach ($planes as $plan) {
            $actividades = DB::table('actividades as ac')
            ->where('ac.id_plan_trabajo', $plan->id_plan_trabajo)
            ->orderby('ac.id_plan_trabajo','desc')
            ->get();
            $actividades_array = array_add($actividades_array, $plan->id_plan_trabajo, array());
            foreach($actividades as $ac){
                $activities = DB::table($ac->nombre_tabla. ' as ac')
                ->where('ac.id_plan_trabajo',$ac->id_plan_trabajo)
                ->get();
                foreach ($activities as $nameActividad) {
                    $nameActividad->nombreActividad = $ac->nombre_actividad;
                    array_push($actividades_array[$ac->id_plan_trabajo], $nameActividad);
                }
                //array_push($actividades_array[$ac->id_plan_trabajo], [$ac->nombre_actividad => $activities]);
            }
        }

        return response()->json(['zonas' => $zonas, 'sucursales' => $sucursales_array, 'planes' => $planes, 'actividades' => $actividades_array]);
    }

    public function alInformationAdmin(Request $request)
    {
       // Se recupera los datos del coordinador para mostrar su region y datos personales

        //obtener zonas del coordinador
        $zonas=DB::table('zona as zo')
        ->select('zo.descripcion_zona', 'uz.id_region', 'zo.id_zona', 'uz.id_usuario')
        ->join('usuario_zona as uz','zo.id_zona','=','uz.id_zona')
        ->join('usuarios_roles as ur','uz.id_usuario','=','ur.id_usuario_roles')
        ->where('ur.id_rol', 1)
        ->get();

       $sucursales_array = array();
       $actividades_array = array();
        foreach($zonas as $zona){
            $sucursales=DB::table('sucursales as su')
            ->select('su.id_suscursal', 'su.cod_sucursal', 'su.nombre', 'su.id_zona', 'ur.id', 'u.nombre as nombre_supervisor', 'u.apellido as apellido_supervisor')
            ->join('usuario_zona as uz', 'su.id_zona', 'uz.id')
            ->join('usuarios_roles as ur', 'uz.id_usuario', 'ur.id')
            ->join('usuario as u', 'ur.id_usuario', 'u.id')
            ->where('su.id_zona',$zona->id_zona)
            ->get();
            $sucursales_array = array_add($sucursales_array, $zona->descripcion_zona, $sucursales);
        }
        $planes=DB::table('plan_trabajo_asignacion as pt')
                ->get();
        foreach ($planes as $plan) {
            $actividades = DB::table('actividades as ac')
            ->where('ac.id_plan_trabajo', $plan->id_plan_trabajo)
            ->orderby('ac.id_plan_trabajo','desc')
            ->get();
            $actividades_array = array_add($actividades_array, $plan->id_plan_trabajo, array());
            foreach($actividades as $ac){
                $activities = DB::table($ac->nombre_tabla. ' as ac')
                ->where('ac.id_plan_trabajo',$ac->id_plan_trabajo)
                ->get();
                foreach ($activities as $nameActividad) {
                    $nameActividad->nombreActividad = $ac->nombre_actividad;
                    array_push($actividades_array[$ac->id_plan_trabajo], $nameActividad);
                }
                //array_push($actividades_array[$ac->id_plan_trabajo], [$ac->nombre_actividad => $activities]);
            }
        }

        return response()->json(['zonas' => $zonas, 'sucursales' => $sucursales_array, 'planes' => $planes, 'actividades' => $actividades_array]);
    }
}
