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
                if($array[$i]["fecha_inicio"]==$array[$j]["fecha_inicio"]){

                    $sw=$sw+1;

                }
            }

        }


    }
    return $sw;


}
//funcion para actividades que el request de las fechas no son array devuelve si exiten fechas de inicio en el mismo plan de rabajo
//y en una actividad o tabla especifica
public function validarQuenoExistanFechasRepetidadEnLaBase($tabla,$id_plan_trabajo,$fecha_inicio){



    $sw=0;
    $respuesta=DB::table($tabla)
    ->select('id_plan_trabajo','fecha_inicio')
    ->where('id_plan_trabajo','=',$id_plan_trabajo)
    ->where('fecha_inicio','=',$fecha_inicio)->get();

    if(count($respuesta)>0){
        $sw=$sw+1;
    }

    return $sw;
}

//funcion que valida las fechas del array recibiendo el aray como parametro y la consulta de una actividad y un
//plan de trabajo se le debe concatenar la hora en la fecha para poder hacer las validaciones
public function validarFechasBaseDatoArray($fechas_array,$consulta){



    $sw=0;
    foreach($fechas_array as $valor){
        foreach($consulta as $valor1){
            if($valor['fecha_inicio'].' 00:00:00' == $valor1->fecha_inicio){
                $sw++;
            }
        }
    }



    return $sw;
}
}
