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

        //obtener el id del rol del usuario
       $usuario_rol = DB::table('usuarios_roles as ur')
       ->where('ur.id_usuario',$user_supervisor->id_usuario)
       ->first();

        //obtener las actividades segun su plan de trabajo 
       $actividades=DB::table('plan_trabajo_asignacion as p')
       ->join('actividades as ac','p.id_plan_trabajo','ac.id_plan_trabajo')
       ->join('sucursales as su','p.id_sucursal','su.id_suscursal')
       ->where('p.id_supervisor',$usuario_rol->id_usuario_roles)
       ->orderby('ac.id_prioridad','desc')
       ->get();
       
       //array que almacenara las actividades correspondientes al dia actual 
       $actividades_habilitadas = array();
       $sucursales_arr = array();

       //bucle que itera las actividades y las obtiene segun la fecha
       foreach($actividades as $ac){
            $fe = DB::table($ac->nombre_tabla. ' as ac')
            ->orderBy('ac.id_prioridad', 'desc')
            ->get();

            foreach($fe as $fecha){
                if($fecha->fecha_inicio == date('Y-m-d 00:00:00') && $fecha->id_plan_trabajo == $ac->id_plan_trabajo){
                    $fecha->nombre_tabla = $ac->nombre_tabla;
                    $fecha->nombre_actividad = $ac->nombre_actividad;
                    $actividades_habilitadas = array_add($actividades_habilitadas, $ac->nombre_actividad, $fecha);
                }
                $sucursales_arr = array_add($sucursales_arr, $ac->nombre, $actividades_habilitadas);


            }
            
        }
            return response()->json(['Actividades' => $sucursales_arr,'datos_usuario' => $user_supervisor]);
        
    }

}
