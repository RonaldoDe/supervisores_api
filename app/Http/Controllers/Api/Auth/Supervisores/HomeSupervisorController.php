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
    //informacion inicial de un supervisor
    public function index(Request $request)
    {

        //Se recupera los datos del usuario que se ha autenticado
       $user=DB::table('users as u')->where('u.id','=',Auth::id())->first();

       //obtener los datos del usuario supervisor
       $user_supervisor=DB::table('usuario as u')
       ->select('u.id_usuario', 'u.nombre', 'u.apellido', 'u.cedula', 'u.correo', 'u.telefono', 'u.codigo', 'u.foto')
       ->where('u.correo','=',$user->email)->first();

        //obtener el id del rol del usuario
       $usuario_rol = DB::table('usuarios_roles as ur')
       ->where('ur.id_usuario',$user_supervisor->id_usuario)
       ->first();

       $usuario_zona = DB::table('usuario_zona as uz')
       ->where('uz.id_usuario',$usuario_rol->id_usuario_roles)
       ->first();
       
       //obtener las actividades segun su plan de trabajo
       $actividades=DB::table('plan_trabajo_asignacion as p')
       ->join('actividades as ac','p.id_plan_trabajo','ac.id_plan_trabajo')
       ->join('sucursales as su','p.id_sucursal','su.id_suscursal')
       ->where('su.id_zona',$usuario_zona->id_zona)
       ->where('p.estado',1)
       ->orderby('su.nombre','asc')
       ->get();

       //array que almacenara las actividades correspondientes al dia actual
       $actividades_habilitadas = array();

       //bucle que itera las actividades y las obtiene segun la fecha
       foreach($actividades as $ac){
            $fe = DB::table($ac->nombre_tabla. ' as ac')
            ->where('ac.id_estado',1)
            ->ORwhere('ac.id_estado',2)
            ->get();

            //obtener las actividades asiganadas a la fecha actual de un supervisor
            foreach($fe as $fecha){
                if((date('Y-m-d').' 00:00:00' >= $fecha->fecha_inicio && date('Y-m-d').' 00:00:00' <= $fecha->fecha_fin && $fecha->id_plan_trabajo == $ac->id_plan_trabajo) || $fecha->id_estado == 3){
                    $fecha->nombre_tabla = $ac->nombre_tabla;
                    $fecha->nombre_sucursal = $ac->nombre;
                    $fecha->cod_sucursal = $ac->cod_sucursal;
                    $fecha->id_sucursal = $ac->id_suscursal;
                    $fecha->direccion = $ac->direccion;
                    $fecha->nombre_actividad = $ac->nombre_actividad;
                    $actividades_habilitadas = array_add($actividades_habilitadas, $ac->nombre.'-'.$fecha->id_plan_trabajo.'-'.$fecha->nombre_tabla.'-'.$fecha->id, $fecha);
                }
            }

        }
        //validar que el array trae actividades y ordenarlas por prioridad
        return response()->json(['Actividades' => $actividades_habilitadas,'datos_usuario' => $user_supervisor], 200);
            
    }
    //datos del supervisor logueado
    public function profileUser()
    {
        $user=DB::table('users as u')->where('u.id','=',Auth::id())->first();

       //obtener los datos del usuario supervisor
       $user_supervisor=DB::table('usuario as u')
       ->select('u.id_usuario', 'u.nombre', 'u.apellido', 'u.cedula', 'u.correo', 'u.telefono', 'u.codigo', 'u.foto', 'ur.id_rol')
       ->join('usuarios_roles as ur', 'u.id_usuario', 'ur.id_usuario')
       ->where('u.correo','=',$user->email)->first();


       if($user_supervisor){
            return response()->json($user_supervisor, 200);
       }else{
        return response()->json('Usuario no existe', 400);
       }
    }

}
