<?php

namespace App\Http\Controllers\Api\Auth\Supervisores;

use Illuminate\Http\Request;
use Laravel\Passport\Client;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Modelos\Usuario;
use App\Modelos\Usuario_roles;


class HomeSupervisorController extends Controller
{
/*Author Ronaldo camacho */

    public function index(Request $request)
    {

        //Se recupera los datos del usuario que se ha autenticado
       $user=DB::table('users as u')->where('u.id','=',Auth::id())->first();
       //obtener los datos del usuario supervisor
       $user_supervisor=DB::table('usuario as u')->where('u.correo','=',$user->email)->first();

       $usuario_rol = DB::table('usuarios_roles as ur')
       ->where('ur.id_usuario',$user_supervisor->id_usuario)
       ->first();

       $actividades=DB::table('plan_trabajo_asignacion as p')
       ->join('actividades as ac','p.id_plan_trabajo','ac.id_plan_trabajo')
       ->where('p.id_supervisor',$usuario_rol->id_usuario_roles)
       ->orderby('ac.id_prioridad','desc')
       ->get();
    //    $array_actividades = array();
    //     foreach($plan_trabajo as $pt){
    //         $actividades = DB::table('actividades as ac')
    //         ->select('ac.nombre_actividad', 'ac.id as id_actividad', 'ac.id_plan_trabajo', 'su.id_suscursal', 'su.cod_sucursal', 'su.latitud', 'su.longitud', 'zo.descripcion_zona', 'zo.id_zona')
    //         ->join('plan_trabajo_asignacion as pt', 'ac.id_plan_trabajo','pt.id_plan_trabajo')
    //         ->join('sucursales as su', 'pt.id_sucursal','su.id_suscursal')
    //         ->join('zona as zo','su.id_zona','=','zo.id_zona')
    //         ->where('ac.id_plan_trabajo',$pt->id_plan_trabajo)
    //         ->get();

    //         $array_actividades = array_add($array_actividades, 'plan '.$pt->id_plan_trabajo, $actividades);
    //     }

        $array_actividades = array();
        foreach($actividades as $ac){
            $hoy = DB::table($ac->nombre_actividad)
            ->get();
        }
        
        return response()->json(["actividades"=>$array_actividades]);

    }

}
