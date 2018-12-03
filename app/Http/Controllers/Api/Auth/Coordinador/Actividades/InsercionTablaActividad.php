<?php

namespace App\Http\Controllers\Api\Auth\Coordinador\Actividades;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Modelos\Actividades\ActividadesTabla;

class InsercionTablaActividad extends Controller
{

    //controlador para insertar  a la tabla actividades el nomvre  el plan derabajo para rrecorrelo desde al ap y lo devuelva
    //al supervisor sus actividades que debe hacer

public function insertarTablasAactividad(Request $request){

    $validator=\Validator::make($request->all(),[
        'id_plan_trabajo'=>'required|numeric',

       'array_actividades.*.id_prioridad'=>'required|numeric',
       'array_actividades.*.nombre_tabla'=>'required',
       'array_actividades.*.nombre_actividad'=>'required'

       ]);

       if($validator->fails())
       {
           return response()->json( $errors=$validator->errors()->all() );
    }

    else
    {

        $actividades=request('array_actividades');
        $actividades_converter=json_encode($actividades,true);

        $actividades_converter_d=json_decode($actividades_converter,true);



        for($i=0; $i<sizeof($actividades_converter_d);$i++){

            $actividad =ActividadesTabla::create([

                'id_plan_trabajo' =>request('id_plan_trabajo'),
                'id_prioridad' =>$actividades_converter_d[$i]["id_prioridad"],
                'nombre_tabla' =>$actividades_converter_d[$i]["nombre_tabla"],
                'nombre_actividad'=>$actividades_converter_d[$i]["nombre_actividad"]

                ]);


        }


        return response()->json(["message "=>'Activida creada cvX50'],201);

    }

}


}
