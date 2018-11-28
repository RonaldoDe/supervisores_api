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

class ListarActividadesController extends Controller
{
    public function index()
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
    ->orderby('ac.id_plan_trabajo','desc')
    ->get();
    $count = 0;
    
    //array que almacenara las actividades correspondientes al dia actual 
    $actividades_arr = array();
    $lista_actividades_arr = array();
    //bucle que itera las actividades y las obtiene segun la fecha
    foreach($actividades as $ac){
        $fe = DB::table($ac->nombre_tabla. ' as ac')
         ->select('ac.fecha_inicio', 'ac.fecha_fin', 'ac.id_plan_trabajo')
         ->where('ac.estado','activo')
         ->where('ac.id_plan_trabajo',$ac->id_plan_trabajo)
         ->get();

         $count++;
        foreach($fe as $fecha){
            if($fecha->id_plan_trabajo == $ac->id_plan_trabajo){
                $fecha->nombre_actividad = $ac->nombre_actividad;
                array_push($lista_actividades_arr, [$ac->nombre =>$fecha]);
                //  $actividades_habilitadas = array_add($actividades_habilitadas, $ac->nombre_actividad, $lista_actividades_arr);
                // $lista_actividades_arr = array_add($lista_actividades_arr, $ac->nombre, [$count.' '.$ac->nombre_actividad => $fecha]);
                
            }
        }
        
        
    }
         if(count($lista_actividades_arr) > 0){
             
             return response()->json(['Actividades' => $lista_actividades_arr],200);
         }else{
             return response()->json(['Actividades' => 'No tienes actividadedes'],400);
         }
    }
         
}
