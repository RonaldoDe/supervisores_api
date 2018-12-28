<?php

namespace App\Http\Controllers\Api\Auth\Coordinador\Actividades;

use Illuminate\Http\Request;
use Laravel\Passport\Client;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Modelos\Actividades\Apertura;
use App\Modelos\Actividades\DocumentacionLegal;
use App\Modelos\Actividades\PapeleriaConsignaciones;
use App\Modelos\Actividades\FormulasDespachos;
use App\Modelos\Actividades\Remisiones;
use App\Modelos\Actividades\CondicionesLocativas;
//use App\Modelos\Relevancia;

/*Author jhonatan cudris */

//controlador que crea el registro de apertura  y recibe os parametros
//del front para crear una activdad y asiganerle un plan rbajo
class CrearActividadParaPlanTrabajo extends Controller
{

    public function crearActividadApertura(Request $request)
    {

        $validator=\Validator::make($request->all(),[
            // 'id_prioridad' => 'required|numeric',
            
            'id_plan_trabajo'=>'required|numeric',
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
                    $apertura =Apertura::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>$fechas_converter_d[$i]["fecha_inicio"],
                        'fecha_fin' =>$fechas_converter_d[$i]["fecha_inicio"]." "."23:59:00",
                        'observacion'=>'',
                        'id_prioridad' =>1,
                        'estado' =>'Activo',

                    ]);
                }
                    return response()->json(["success"=>"Actividad Apertura creada", 'id' => $apertura->id],201);
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

//funcion para crear Actividad documnetacion legal del punto de venta  como este actividad se hace cada cierto tiempo
//le mandamos una frecuencia perznalizada paraq ue le cordinador inserte las fechas a estipuladas a cumplir cierta actividad
//


public function crearActividadDocumentacionLegal(Request $request){

    //imporante el id del plana detrabajo debe estar creado a la hora de crear las actividades a dicho plan de trabajo

    $validator=\Validator::make($request->all(),[
        'id_prioridad' => 'required|numeric',
        'id_plan_trabajo'=>'required|numeric',
        'fecha_inicio'=>'date_format:"Y-m-d"|required',
        'fecha_fin'=>'date_format:"Y-m-d"|required'

    ]);
    if($validator->fails())
    {
      return response()->json( $errors=$validator->errors()->all() );
    }

    else
    {



//instancia del modelo documentacion legal para crear un registro de esta tabla

        $fecha= date('Y-m-d');

        if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){


            $fechas_base_datos=DB::table('documentacion_legal')
            ->select('fecha_inicio','id_plan_trabajo','fecha_fin')
            ->where('id_plan_trabajo',request('id_plan_trabajo'))
            ->get();

            $fecha_ini=request('fecha_inicio');
            $fecha_finn=request('fecha_fin');



            $respuesta=$this->validarQuenoExistanFechasRepetidadEnLaBase($fechas_base_datos,$fecha_ini,$fecha_finn);

            if($respuesta>0){

                return response()->json (["error"=>"ya existen  estas  fechas registrada en esta actividad con este plan de trabajo en la base de dato "],400);
            }else{

                $documentacion_legal =DocumentacionLegal::create([

                    'id_plan_trabajo' =>request('id_plan_trabajo'),
                    'fecha_inicio' =>request('fecha_inicio'),
                    'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                    'observacion'=>'',
                    'id_prioridad' =>request('id_prioridad'),
                    'estado' =>'Activo',

                ]);

            }


            return response()->json(["succes"=>" Actividad documentacion legal creada", 'id' => $documentacion_legal->id],201);

        }else{
            return response()->json(["error"=>"las fechas inicio deben ser mayor o igual ala fecha actual y menor o igual a la fecha final"],400);

        }



    }

}




    //metodo que debuelve el contenido de la tabla prioridades para asiganrselo a una actvidad en esécifico
    public function MostrarTablaPrioridad(){

        $prioridad = DB::table('prioridad')->get();
        return response()->json(["prioridades"=>$prioridad]);

    }




//FUNION PARA CREAR LA ACTIVIDAD  PAPELERIA CONSIGNACIONES
    public function crearActividadPapeleriaConsignaciones(Request $request){

        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required|numeric',

            'id_plan_trabajo'=>'required|numeric',
            'array_fechas_papeleria.*.fecha_inicio'=>'date_format:"Y-m-d"|required|date',
            'array_fechas_papeleria.*.fecha_fin'=>'date_format:"Y-m-d"|required|date'



        ]);
        if($validator->fails())
        {
          return response()->json( $errors=$validator->errors()->all() );
        }

        else
        {

            $fechas=request('array_fechas_papeleria');
            //codificacion a json
            $fechas_converter=json_encode($fechas,true);
            //decodificcion del reques recibido para iterar el aary
            $fechas_converter_d=json_decode($fechas_converter,true);

            $fechas_base_datos=DB::table('papeleria_consignaciones')
            ->select('fecha_inicio','id_plan_trabajo','fecha_fin')
            ->where('id_plan_trabajo',request('id_plan_trabajo'))
            ->get();

            $validacion=$this->validarArrayFechas($fechas_converter_d);

            if($validacion==0)
            {

               for($i=0; $i<sizeof($fechas_converter_d);$i++)
               {

                $validacionFechas=$this->validarFechasInicioRepetido($fechas_converter_d);

                if($validacionFechas==0){

                    $validacion_fecha_base=$this->validarFechasBaseDatoArray($fechas_converter_d,$fechas_base_datos);

                    if($validacion_fecha_base > 0){
                        return response()->json(["error"=>'ya existen  estas  fechas registrada en esta actividad con este plan de trabajo en la base de dato '],400);
                    }else{

                   $papeleria =PapeleriaConsignaciones::create([

                       'id_plan_trabajo' =>request('id_plan_trabajo'),
                       'fecha_inicio' =>$fechas_converter_d[$i]["fecha_inicio"],
                       'fecha_fin' =>$fechas_converter_d[$i]["fecha_fin"]." "."23:59:00",
                       'observacion'=>'',
                       'id_prioridad' =>request('id_prioridad'),
                       'estado' =>'Activo',


                   ]);

                    }
                }else{
                    return response()->json(["error"=>"las fechas inicios o fechas  finales no pueden ser  iguales"],400);
                }

               }
               return response()->json(["succes"=>" papeleria consignacion creada", 'id' => $papeleria->id],201);
            }
            else if($validacion>0){
                return response()->json(["error"=>"las fechas inicio deben ser mayor o igual ala fecha actual y menor o igual a la fecha final"],400);
            }



            }

    }

    public function crearActividadFormulaDespachos(Request $request){

        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required|numeric',

            'id_plan_trabajo'=>'required|numeric',
            'array_fechas_formulas.*.fecha_inicio'=>'date_format:"Y-m-d"|required|date',
            'array_fechas_formulas.*.fecha_fin'=>'date_format:"Y-m-d"|required|date',

        ]);
        if($validator->fails())
        {
          return response()->json( $errors=$validator->errors()->all() );
        }

        else
        {


            $fechas=request('array_fechas_formulas');
            //codificacion a json
            $fechas_converter=json_encode($fechas,true);
            //decodificcion del reques recibido para iterar el aary
            $fechas_converter_d=json_decode($fechas_converter,true);

            $fechas_base_datos=DB::table('formulas_despachos')
            ->select('fecha_inicio','id_plan_trabajo','fecha_fin')
            ->where('id_plan_trabajo',request('id_plan_trabajo'))
            ->get();

            $validacion=$this->validarArrayFechas($fechas_converter_d);

            if($validacion==0)
            {

               for($i=0; $i<sizeof($fechas_converter_d);$i++)
               {
                $validacionFechas=$this->validarFechasInicioRepetido($fechas_converter_d);

                if($validacionFechas==0){

                    $validacion_fecha_base=$this->validarFechasBaseDatoArray($fechas_converter_d,$fechas_base_datos);

                    if($validacion_fecha_base > 0){
                        return response()->json(["error"=>'ya existen  estas  fechas registrada en esta actividad con este plan de trabajo en la base de dato'],400);
                    }else{

                   $formulas =FormulasDespachos::create([

                       'id_plan_trabajo' =>request('id_plan_trabajo'),
                       'fecha_inicio' =>$fechas_converter_d[$i]["fecha_inicio"],
                       'fecha_fin' =>$fechas_converter_d[$i]["fecha_fin"]." "."23:59:00",
                       'observacion'=>'',
                       'id_prioridad' =>request('id_prioridad'),
                       'estado' =>'Activo',


                   ]);
                    }
                }else{
                    return response()->json(["error"=>"las fechas inicios o fechas  finales no pueden ser  iguales por registros diferentes"],400);
                }

               }
               return response()->json(["succes"=>" formulas despachos creada", $formulas->id],201);
            }

            else if($validacion>0){
                return response()->json(["error"=>"las fechas inicio deben ser mayor o igual ala fecha actual y menor o igual a la fecha final"],400);
            }


            }


    }

    public function crearActividadRemisiones(Request $request){



        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required|numeric',

            'id_plan_trabajo'=>'required|numeric',
            'array_fechas_remisiones.*.fecha_inicio'=>'date_format:"Y-m-d"|required|date',
            'array_fechas_remisiones.*.fecha_fin'=>'date_format:"Y-m-d"|required|date',



        ]);
        if($validator->fails())
        {
          return response()->json( $errors=$validator->errors()->all() );
        }

        else
        {


            $fechas=request('array_fechas_remisiones');
            //codificacion a json
            $fechas_converter=json_encode($fechas,true);
            //decodificcion del reques recibido para iterar el aary
            $fechas_converter_d=json_decode($fechas_converter,true);

            $fechas_base_datos=DB::table('remisiones')
            ->select('fecha_inicio','id_plan_trabajo','fecha_fin')
            ->where('id_plan_trabajo',request('id_plan_trabajo'))
            ->get();

            $validacion=$this->validarArrayFechas($fechas_converter_d);

            if($validacion==0)
            {

               for($i=0; $i<sizeof($fechas_converter_d);$i++)
               {

                $validacionFechas=$this->validarFechasInicioRepetido($fechas_converter_d);

                if($validacionFechas==0){

                    $validacion_fecha_base=$this->validarFechasBaseDatoArray($fechas_converter_d,$fechas_base_datos);

                    if($validacion_fecha_base > 0){
                        return response()->json(["error"=>'ya existen  estas  fechas registrada en esta actividad con este plan de trabajo en la base de dato'],400);
                    }else{
                   $remisiones =Remisiones::create([

                       'id_plan_trabajo' =>request('id_plan_trabajo'),
                       'fecha_inicio' =>$fechas_converter_d[$i]["fecha_inicio"],
                       'fecha_fin' =>$fechas_converter_d[$i]["fecha_fin"]." "."23:59:00",
                       'observacion'=>'',
                       'id_prioridad' =>request('id_prioridad'),
                       'estado' =>'Activo',


                   ]);

                    }

                }else{
                    return response()->json(["error"=>"las fechas inicios o fechas  finales no pueden ser  iguales por registros diferentes"],400);
                }

               }
               return response()->json(["succes"=>" actividad remision creada", 'id' => $remisiones->id],201);
            }
            else if($validacion>0){
                return response()->json(["error"=>"las fechas inicio deben ser mayor o igual ala fecha actual y menor o igual a la fecha final"],400);
            }



            }

    }


    public function crearActividadCondicionesLocativas(Request $request){


        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required|numeric',
            'id_plan_trabajo'=>'required|numeric',
            'fecha_inicio'=>'date_format:"Y-m-d"|required',
            'fecha_fin'=>'date_format:"Y-m-d"|required'




        ]);
        if($validator->fails())
        {
          return response()->json( $errors=$validator->errors()->all() );
        }

        else
        {

            $fecha= date('Y-m-d');

            if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){

                $fechas_base_datos=DB::table('condiciones_locativas')
                ->select('fecha_inicio','id_plan_trabajo','fecha_fin')
                ->where('id_plan_trabajo',request('id_plan_trabajo'))
                ->get();

            $fecha_ini=request('fecha_inicio');
            $fecha_finn=request('fecha_fin');


//funcion que valida las fechas a insertar en la base de dato hay que colocar esta funcion en las actividades qe
//no son tan frecuentes y hay que hacer la funcion para os planes de trabajos que son frecuentes
        $respuesta=$this->validarQuenoExistanFechasRepetidadEnLaBase($fechas_base_datos,$fecha_ini,$fecha_finn);


        if($respuesta>0){

            return response()->json (["error"=>"ya existen  estas  fechas registrada en esta actividad con este plan de trabajo en la base de dato"],400);

        }else{


    //instancia del modelo documentacion legal para crear un registro de esta tabla
                $condiciones_locativas =CondicionesLocativas::create([

                    'id_plan_trabajo' =>request('id_plan_trabajo'),
                    'fecha_inicio' =>request('fecha_inicio'),
                    'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                    'observacion'=>'',
                    'id_prioridad' =>request('id_prioridad'),
                    'estado' =>'Activo',

                ]);
        }

                // DB::commit();

                return response()->json(["succes"=>" Actividad documentacion legal creada", 'id' => $condiciones_locativas->id],201);
                }
                else{
                    return response()->json(["error"=>" las fechas inicio deben ser mayor o igual ala fecha actual y menor o igual a la fecha final"],400);

                }
        }



    }
}



