<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\User;
use App\Apertura;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Modelos\Notificaciones;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function validarFechasSucursal($id_plan, $fecha_inicio, $fecha_fin, $actividad)
    {
        $sucursalPlan = DB::table('plan_trabajo_asignacion')
                ->where('id_plan_trabajo', $id_plan)
                ->orderBy('id_sucursal', 'desc')
                ->first();

                $planesSucursal = DB::table('plan_trabajo_asignacion')
                ->where('id_sucursal', $sucursalPlan->id_sucursal)
                ->orderBy('id_sucursal', 'desc')
                ->get();
                 
                foreach($planesSucursal as $planSucursal){
                        $validarDuplicadoFechas = DB::table($actividad)
                        ->select('id', 'fecha_inicio', 'fecha_fin', 'id_plan_trabajo')
                        ->where('id_plan_trabajo', $planSucursal->id_plan_trabajo)
                        ->where('id_estado', 1)
                        ->get();
                        if(count($validarDuplicadoFechas) > 0){
                            foreach ($validarDuplicadoFechas as $fechasDuplicadas) {
                                if($fecha_inicio.' 00:00:00' >= $fechasDuplicadas->fecha_inicio && $fecha_inicio.' 00:00:00' <= $fechasDuplicadas->fecha_fin){
                                    return 0;
                                }

                                if($fecha_fin.' 23:59:00' >= $fechasDuplicadas->fecha_inicio && $fecha_fin.' 23:59:00' <= $fechasDuplicadas->fecha_fin){
                                    return 0;

                                }
                            }
                        }

                        if(count($validarDuplicadoFechas) > 0){
                            foreach ($validarDuplicadoFechas as $fechasDuplicadas) {
                                if($fechasDuplicadas->fecha_inicio >=  $fecha_inicio.' 00:00:00' && $fechasDuplicadas->fecha_inicio <= $fecha_fin.' 00:00:00'){
                                    return 0;

                                }
                                if($fechasDuplicadas->fecha_fin >= $fecha_inicio.' 23:59:00' && $fechasDuplicadas->fecha_fin <= $fecha_fin.' 23:59:00'){
                                    return 0;

                                }
                            }
                        }
                    
                }
                return 1;
    }

public function validarQuenoExistanFechasRepetidadEnLaBase($consulta,$fecha_ini,$fecha_finn){



    $sw=0;
    foreach($consulta as $valor){
        if($valor->fecha_inicio == $fecha_ini.' 00:00:00' || $valor->fecha_fin ==$fecha_finn.' 23:59:00'){

         $sw++;


        }

    }



    return $sw;
}

//funcion que valida las fechas del array recibiendo el aray como parametro y la consulta de una actividad y un
//plan de trabajo se le debe concatenar la hora en la fecha para poder hacer las validaciones
public function validarFechasBaseDatoArray($fechas_array,$consulta){



    $sw=0;
    foreach($fechas_array as $valor){
        foreach($consulta as $valor1){
            if($valor['fecha_inicio'].' 00:00:00' == $valor1->fecha_inicio || $valor['fecha_fin'].' 23:59:00' == $valor1->fecha_fin){
                $sw++;
            }
        }
    }



    return $sw;
}

public function validarQueExistaElPlandeTrabajo($id_planT){
$sw=0;

    $plan_trabajo_existente=DB::table('plan_trabajo_asignacion')
    ->select('id_plan_trabajo')
    ->where('id_plan_trabajo','=',$id_planT)
    ->get();

    return $plan_trabajo_existente;
    // if(count($plan_trabajo_existente)>0){

    //     $sw=$SW+1;
    // }
    // return


}

    public function logMovimientoCoordinador($id, $accion)
    {
        //obtener datos del coordinador registrado
       $user=DB::table('users as u')->where('u.id','=',Auth::id())->first();
       $coordinador=DB::table('coordinadores')->where('correo','=',$user->email)->first();

    }

    public function logCrearNotificaciones($id_plan_trabajo, $nombre_tabla)
    {
        
        $nombre_plan = DB::table('plan_trabajo_asignacion')
        ->select('nombre', 'id_sucursal')
        ->where('id_plan_trabajo', $id_plan_trabajo)
        ->first();
        
        $nombre_sucursal = DB::table('sucursales')
        ->select('id_suscursal', 'cod_sucursal', 'nombre')
        ->where('id_suscursal', $nombre_plan->id_sucursal)
        ->first();
        
        $nombre_actividad = DB::table('actividades')
        ->select('nombre_actividad')
        ->where('nombre_tabla',$nombre_tabla)
        ->where('id_plan_trabajo',$id_plan_trabajo)
        ->first();
        
        //Se recupera los datos del usuario que se ha autenticado
        $user=DB::table('users as u')->where('u.id','=',Auth::id())->first();

        $supervisor=DB::table('usuario')
        ->where('correo','=',$user->email)->first();
        
        $usuario_rol=DB::table('usuarios_roles')
        ->where('id_usuario','=',$supervisor->id_usuario)->first();

        $region = DB::table('usuario_zona')
        ->where('id_usuario','=',$usuario_rol->id_usuario_roles)->first();

        $coordinador = DB::table('region')
        ->where('id_region','=',$region->id_region)->first();

        if($user != null){
            //obtener los datos del usuario supervisor
            $nombre_supervisor=DB::table('usuario as u')
            ->select('u.id_usuario', 'u.nombre', 'u.apellido')
            ->where('u.correo','=',$user->email)->first();

            $notificacion =Notificaciones::create([
                'id_plan_trabajo' =>$id_plan_trabajo,
                'id_coordinador' =>$coordinador->id_cordinador,
                'id_usuario' => $usuario_rol->id_usuario_roles,
                'id_sucursal' => $nombre_sucursal->id_suscursal,
                'nombre_plan' =>$nombre_plan->nombre,
                'nombre_actividad' =>$nombre_actividad->nombre_actividad,
                'nombre_supervisor' => $nombre_supervisor->nombre.' '.$nombre_supervisor->apellido,
                'nombre_sucursal' => $nombre_sucursal->nombre,
                'tipo' => 1,
                'tipo_usuario' => 2,
                'fecha' => date('Y-m-d H:i:s'),

            ]);

            return $notificacion;
        }
    }

    public function logCrearNotificacionesMensaje($id_reporte, $id_coordinador, $usuario,$nombre_reporte, $nombre_creador, $tipo, $tipo_usuario)
    {
        
        if($id_reporte != ''){
            //obtener los datos del usuario supervisor

            $notificacion =Notificaciones::create([
                'id_plan_trabajo' =>$id_reporte,
                'id_coordinador' =>$id_coordinador,
                'id_usuario' => $usuario,
                'nombre_plan' =>$nombre_reporte,
                'nombre_supervisor' => $nombre_creador,
                'tipo' => $tipo,
                'tipo_usuario' => $tipo_usuario,
                'fecha' => date('Y-m-d H:i:s'),

            ]);

            return $notificacion;
        }
    }
}
