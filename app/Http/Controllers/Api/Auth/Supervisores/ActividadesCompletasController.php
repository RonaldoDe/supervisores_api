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
class ActividadesCompletasController extends Controller
{
    public function index()
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
       ->orWhere('p.estado',2)
       ->orderby('ac.id_plan_trabajo','desc')
       ->get();

       //array que almacenara las actividades correspondientes al dia actual
       $actividades_habilitadas = array();

       //bucle que itera las actividades y las obtiene segun la fecha y el estado completo
       foreach($actividades as $ac){
            $fe = DB::table($ac->nombre_tabla. ' as ac')
            ->where('ac.id_estado',2)
            ->get();

            foreach($fe as $fecha){
                if(date('Y-m-d').' 00:00:00' >= $fecha->fecha_inicio && date('Y-m-d').' 00:00:00' <= $fecha->fecha_fin && $fecha->id_plan_trabajo == $ac->id_plan_trabajo){
                    $fecha->nombre_tabla = $ac->nombre_tabla;
                    $fecha->nombre_sucursal = $ac->nombre;
                    $fecha->cod_sucursal = $ac->cod_sucursal;
                    $fecha->id_sucursal = $ac->id_suscursal;
                    $fecha->direccion = $ac->direccion;
                    $actividades_habilitadas = array_add($actividades_habilitadas, $ac->nombre_actividad.'-'.$fecha->id_plan_trabajo, $fecha, $fecha);

                }
            }


        }
        //validar que el array trae actividades y ordenarlas por prioridad
            if(count($actividades_habilitadas) > 0){
                return response()->json(['Actividades' => $actividades_habilitadas,'datos_usuario' => $user_supervisor], 200);
            }else{
                return response()->json(['Actividades' => 'No tienes actividadedes para el dia de hoy','datos_usuario' => $user_supervisor],400);
            }


    }

}
