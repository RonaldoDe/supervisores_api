<?php

namespace App\Http\Controllers\Api\Auth\Coordinador\Reporte;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AllInformationController extends Controller
{
    public function alInformation(Request $request)
    {
        $user=DB::table('users as u')->where('u.id','=',Auth::id())->first();
        $coordinador=DB::table('coordinadores')->where('correo','=',$user->email)->first();


       // Se recupera los datos del coordinador para mostrar su region y datos personales
       $region=DB::table('region as r')
                        ->join('coordinadores as c','c.id_cordinador','=','r.id_cordinador')
                        ->select('r.id_region','r.nombre as region','c.apellido','c.nombre','r.id_cordinador')
                        ->where('r.id_cordinador','=',$coordinador->id_cordinador)
                        ->first();

        $zonas=DB::table('zona as zo')
        ->where('zo.id_region',$region->id_region)
        ->get();

       $sucursales_array = array();
       $planes_array = array();
       $actividades_array = array();
        foreach($zonas as $zona){
            $sucursales=DB::table('sucursales as su')
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
}
