<?php

namespace App\Http\Controllers\Api\Auth\Coordinador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PlanesController extends Controller
{
    public function listarActividades(Request $request)
    {

        $user=DB::table('users as u')->where('u.id','=',Auth::id())->first();
        $coordinador=DB::table('coordinadores')->where('cedula',$user->cedula)->first();


        //obtener las actividades segun su plan de trabajo 
        $actividades=DB::table('plan_trabajo_asignacion as p')
        ->select('su.nombre as nombreSucursal', 'p.nombre as nombrePlan', 'ac.nombre_tabla', 'p.id_plan_trabajo', 'ac.nombre_actividad')
        ->join('actividades as ac','p.id_plan_trabajo','ac.id_plan_trabajo')
        ->join('sucursales as su','p.id_sucursal','su.id_suscursal')
        ->where('p.id_plan_trabajo',request('id_plan_trabajo'))
        ->where('p.idcoordinador',$coordinador->id_cordinador)
        ->orderby('ac.id_plan_trabajo','desc')
        ->get();
        
        //array que almacenará las actividanes correspondientes a los 7 dias despues del dia actual 
        $lista_actividades_arr = array();
        //bucle que itera las actividades y las obtiene segun el plan de trabajo
        foreach($actividades as $ac){
            $fe = DB::table($ac->nombre_tabla. ' as ac')
            ->select('ac.fecha_inicio', 'ac.fecha_fin', 'ac.id_plan_trabajo')
            ->where('ac.id_plan_trabajo',$ac->id_plan_trabajo)
            ->get();

            //  generar el array con el listado de actividades pendientes en la semana
            foreach($fe as $fecha){
                $fecha->nombre_actividad = $ac->nombre_actividad;
                $fecha->nombrePlan = $ac->nombrePlan;
                array_push($lista_actividades_arr, [$ac->nombreSucursal =>$fecha]);
            }
            
            
        }
            // validar si el array tiene actividades
        if(count($lista_actividades_arr) > 0){
            return response()->json(['Actividades' => $lista_actividades_arr],200);
        }else{
            return response()->json(['Actividades' => 'No tienes actividadedes'],400);
        }
    }
    
}
