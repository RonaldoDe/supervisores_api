<?php

namespace App\Http\Controllers\Api\Auth\Coordinador\Actividades;

use Illuminate\Http\Request;
use Laravel\Passport\Client;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Modelos\Actividades\Kardex;

class CrearActividadParaPlanTrabajo2 extends Controller
{

    public function crearActividadAKardex(Request $request)
    {






        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required',
            'id_plan_trabajo'=>'required',
            'array_fechas_kardex.*.fecha_inicio'=>'date_format:"Y-m-d"|required|date',
            'array_fechas_kardex.*.fecha_fin'=>'date_format:"Y-m-d"|required|date'
        ]);
        if($validator->fails())
        {
          return response()->json( $errors=$validator->errors()->all() );
        }

        else
        {


            $fechas=request('array_fechas_kardex');
            //codificacion a json
            $fechas_converter=json_encode($fechas,true);
            //decodificcion del reques recibido para iterar el aary
            $fechas_converter_d=json_decode($fechas_converter,true);

           //isntancia de la funcion omnipotente para la validacion de las fechas establecida en Controller
               $validacion=$this->validarArrayFechas($fechas_converter_d);

              if($validacion==0)
              {
                  //se vuelve a iterrar el array para obtener los valores de las fechas i hacer las inserciones
                for($i=0; $i<sizeof($fechas_converter_d);$i++)
                {
                $kardex =Kardex::create([

                    'id_plan_trabajo' =>request('id_plan_trabajo'),
                    'fecha_inicio' =>$fechas_converter_d[$i]["fecha_inicio"],
                    'fecha_fin' =>$fechas_converter_d[$i]["fecha_fin"]." "."23:59:00",
                    'observacion'=>'',
                    'id_prioridad' =>request('id_prioridad'),
                    'estado' =>'Activo',

                ]);
                }
                return response()->json(["succes"=>"Actividad Kardex creada"],201);
              }
              elseif($validacion>0)
              {
                return response()->json(["error"=>"ERROR"],401);
              }





            }
    }

}

