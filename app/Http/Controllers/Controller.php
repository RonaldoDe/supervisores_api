<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\User;
use App\Apertura;
use Illuminate\Support\Facades\DB;

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
}
