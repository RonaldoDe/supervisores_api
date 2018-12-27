<?php

namespace App\Http\Controllers\Api\Auth\Coordinador\Actividades;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Modelos\Actividades\Apertura;

class UpdateActividadesController extends Controller
{
    public function updateActividadApertura(Request $request)
    {

        $validator=\Validator::make($request->all(),[
            // 'id_prioridad' => 'required|numeric',
            
            'id_plan_trabajo'=>'required|numeric',
            'id_actividad'=>'required',
            'array_fechas_apertura.*.fecha_inicio'=>'date_format:"Y-m-d"|required|date',

        ]);
        if($validator->fails())
        {
          return response()->json( $errors=$validator->errors()->all());
        }

        else
        {
            $id_planT=request('id_plan_trabajo');

            $fechas=request('array_fechas_apertura');
            //codificacion a json
            $fechas_converter=json_encode($fechas,true);
            //decodificcion del reques recibido para iterar el aary
            $fechas_converter_d=json_decode($fechas_converter,true);

            //consulta ala base de dato para traer todas las fechas de una actividad en un lan de trabajo especifico
            $fechas_base_datos=DB::table('apertura')
                        ->select('fecha_inicio','id_plan_trabajo','fecha_fin')
                        ->where('id_plan_trabajo',request('id_plan_trabajo'))
                        ->get();



               //ciclo que me me permite iterar el array  mediante la funcion sizeof
               //itera mediante las propiedades del array asi como le mando los parametros
               //exactos los nombres de las propiedades

            //funcion en contrler que valida que un plan de trabajo exista en la base de datos
               $validarPlanTrabajo=$this->validarQueExistaElPlandeTrabajo($id_planT);

               if(count($validarPlanTrabajo)>0){
                $sw=0;
                $fecha= date('Y-m-d');
                for($i=0;$i<sizeof($fechas_converter_d);$i++){

        if($fechas_converter_d[$i]["fecha_inicio"]>=$fecha ){

            $sw;


        }else{
            $sw=$sw+1;
        }

                }

                if($sw==0){

                    $sw1=0;

                    for($j=0;$j<sizeof($fechas_converter_d);$j++){

                        for($k=0;$k<sizeof($fechas_converter_d);$k++){

                            if($k!=$j)
            {
                if($fechas_converter_d[$j]["fecha_inicio"]==$fechas_converter_d[$k]["fecha_inicio"] ){

                    $sw1=$sw1+1;

                }
            }

                        }


                    }

                }else{
                    return response()->json(["error"=>"las fechas inicio deben ser mayor o igual ala fecha actual "],400);
                }

                $sw2=0;
                if($sw1==0){



                    foreach($fechas_converter_d as $valor){

                        foreach($fechas_base_datos as $valor1){

                        if($valor['fecha_inicio'].' 00:00:00' == $valor1->fecha_inicio ){
                                $sw2++;
                            }
                        }


                    }

                }else{
                    return response()->json(["error"=>"las fechas inicios  no pueden ser  iguales "],400);
                }

                if($sw2>0){

                    return response()->json(["error"=>'ya existen  estas  fechas registrada en esta actividad con este plan de trabajo en la base de dato '],400);

                }else{

                    for($i=0;$i<sizeof($fechas_converter_d);$i++){

                        $actividad = Apertura::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
                        if($actividad!= null){
                            $actividad->fecha_inicio = $fechas_converter_d[$i]["fecha_inicio"];
                            $actividad->fecha_fin = $fechas_converter_d[$i]["fecha_inicio"]." "."23:59:00";
                            $actividad->estado = 'Activo';
                            $actividad->update();
                            return response()->json(['message' => 'Actividad actualizada con exito']);
                        }
                        return response()->json(['message' => 'Error Actividad no encontrada']);
                   
                }
                    return response()->json(["message"=>"Array error"],201);
                }



            //    $validacion=$this->validarArrayFechas($fechas_converter_d);

            //    if($validacion==0)
            //    {
            //    for($i=0; $i<sizeof($fechas_converter_d);$i++)
            //    {
            //     $validacionFechas=$this->validarFechasInicioRepetido($fechas_converter_d);

            //     if($validacionFechas==0){

            //         $validacion_fecha_base=$this->validarFechasBaseDatoArray($fechas_converter_d,$fechas_base_datos);

            //         if($validacion_fecha_base > 0){
            //             return response()->json(["error"=>'ya existen  estas  fechas registrada en esta actividad con este plan de trabajo en la base de dato '],400);
            //         }else{


            //        $apertura =Apertura::create([

            //            'id_plan_trabajo' =>request('id_plan_trabajo'),
            //            'fecha_inicio' =>$fechas_converter_d[$i]["fecha_inicio"],
            //            'fecha_fin' =>$fechas_converter_d[$i]["fecha_inicio"]." "."23:59:00",
            //            'observaciones'=>'',
            //            'id_prioridad' =>1,
            //            'estado' =>'Activo',

            //        ]);
            //         }

            //     }else{
            //         return response()->json(["error"=>"las fechas inicios o fechas  finales no pueden ser  iguales "],400);
            //     }

            //    }
            //    return response()->json(["succes"=>"Actividad Apertura creada"],201);
            // }

            // else if($validacion>0){
            //     return response()->json(["error"=>"las fechas inicio deben ser mayor o igual ala fecha actual y menor o igual a la feca final"],400);
            // }

               }else{

                return response()->json(["error"=>"error este plan trabajo no existe"],400);
               }




            }


    }
}
