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

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    //funcion para validar el array de fechas que me debuelve cada catividad que puede tener un frecuencia mas
    //solicitada
     public function validarArrayFechas($array)
    {

       $fecha= date('Y-m-d');

        $sw=0;
        //iterando el for  con la propiedad helper
     for($i=0; $i<sizeof($array);$i++)
     {
         //entro directamente a la propiedad del array  validndo que la fecha inicio se mayor ala del servidor
         //para que no coloquen planes de trabajo con fechas ya vencida ademas se valida que la fecha inicio sea
         //menor o igual ala fecha fin para que no hallan errores
            if($array[$i]["fecha_inicio"]>=$fecha && $array[$i]["fecha_inicio"]<=$array[$i]["fecha_fin"])
                {
                    $sw;

                }
                else
                {
                    $sw=$sw+1;
                }

     }
          return $sw;

}

//funcion para validar las fechas respetidad por cada registro de una actividad  actividad a un  plan de trabajo
public function validarFechasInicioRepetido($array){
    $sw=0;
    for($i=0; $i<sizeof($array);$i++)
    {
        for($j=0; $j<sizeof($array);$j++){
            if($j!=$i)
            {
                if($array[$i]["fecha_inicio"]==$array[$j]["fecha_inicio"] || $array[$i]["fecha_fin"]==$array[$j]["fecha_fin"]){

                    $sw=$sw+1;

                }
            }

        }


    }
    return $sw;


}
//funcion para actividades que el request de las fechas no son array devuelve si exiten fechas de inicio en el mismo plan de rabajo
//y en una actividad o tabla especifica
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
        ->select('cod_sucursal', 'nombre')
        ->where('id_suscursal', $nombre_plan->id_sucursal)
        ->first();

        $nombre_actividad = DB::table('actividades')
        ->select('nombre_actividad')
        ->where('nombre_tabla',$nombre_tabla)
        ->where('id_plan_trabajo',$id_plan_trabajo)
        ->first();

        //Se recupera los datos del usuario que se ha autenticado
        $user=DB::table('users as u')->where('u.id','=',Auth::id())->first();

        if($user != null){
            //obtener los datos del usuario supervisor
            $nombre_supervisor=DB::table('usuario as u')
            ->select('u.id_usuario', 'u.nombre', 'u.apellido')
            ->where('u.correo','=',$user->email)->first();

            $notificacion =Notificaciones::create([
                'id_plan_trabajo' =>$id_plan_trabajo,
                'nombre_plan' =>$nombre_plan->nombre,
                'nombre_actividad' =>$nombre_actividad->nombre_actividad,
                'nombre_supervisor' => $nombre_supervisor->nombre.' '.$nombre_supervisor->apellido,
                'nombre_sucursal' => $nombre_sucursal->nombre,
                'fecha' => date('Y-m-d H:i:s'),

            ]);

            return $notificacion;
        }
    }
}
