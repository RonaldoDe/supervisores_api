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
            'id_prioridad' => 'required|numeric',
            'id_plan_trabajo'=>'required|numeric',
            'array_fechas_apertura.*.fecha_inicio'=>'date_format:"Y-m-d"|required|date',
            'array_fechas_apertura.*.fecha_fin'=>'date_format:"Y-m-d"|required|date'
        ]);
        if($validator->fails())
        {
          return response()->json( $errors=$validator->errors()->all() );
        }

        else
        {


            $fechas=request('array_fechas_apertura');
            //codificacion a json
            $fechas_converter=json_encode($fechas,true);
            //decodificcion del reques recibido para iterar el aary
            $fechas_converter_d=json_decode($fechas_converter,true);

            //consulta ala base de dato para traer todas las fechas de una actividad en un lan de trabajo especifico
            $fechas_base_datos=DB::table('apertura')
                        ->select('fecha_inicio','id_plan_trabajo')
                        ->where('id_plan_trabajo',request('id_plan_trabajo'))
                        ->get();



               //ciclo que me me permite iterar el array  mediante la funcion sizeof
               //itera mediante las propiedades del array asi como le mando los parametros
               //exactos los nombres de las propiedades
               $validacion=$this->validarArrayFechas($fechas_converter_d);

               if($validacion==0)
               {
               for($i=0; $i<sizeof($fechas_converter_d);$i++)
               {
                $validacionFechas=$this->validarFechasInicioRepetido($fechas_converter_d);

                if($validacionFechas==0){

                    $validacion_fecha_base=$this->validarFechasBaseDatoArray($fechas_converter_d,$fechas_base_datos);

                    if($validacion_fecha_base > 0){
                        return response()->json(["error"=>'Las fechas inicio ya estan en esta actividad con este plan de trabajo'],400);
                    }else{


                   $apertura =Apertura::create([

                       'id_plan_trabajo' =>request('id_plan_trabajo'),
                       'fecha_inicio' =>$fechas_converter_d[$i]["fecha_inicio"],
                       'fecha_fin' =>$fechas_converter_d[$i]["fecha_fin"]." "."23:59:00",
                       'observaciones'=>'',
                       'id_prioridad' =>request('id_prioridad'),
                       'estado' =>'Activo',

                   ]);
                    }

                }else{
                    return response()->json(["error"=>"las fechas inicios  son iguales"],400);
                }

               }
               return response()->json(["succes"=>"Actividad Apertura creada"],201);
            }

            else if($validacion>0){
                return response()->json(["error"=>"ERROR"],400);
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

            $tabla='documentacion_legal';
            $id_plan_t=request('id_plan_trabajo');
            $fecha_ini=request('fecha_inicio');

    $respuesta=$this->validarQuenoExistanFechasRepetidadEnLaBase($tabla,$id_plan_t,$fecha_ini);

    if($respuesta>0){

        return response()->json (["error"=>"ya hay un registro con esta fecha de inicio en esta actividad y este plan de trabajo"],400);

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



            return response()->json(["succes"=>" Actividad documentacion legal creada"],201);

        }else{
            return response()->json(["error"=>" fallaron las fechas"],400);

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
            ->select('fecha_inicio','id_plan_trabajo')
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
                        return response()->json(["error"=>'Las fechas inicio ya estan en esta actividad con este plan de trabajo'],400);
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
                    return response()->json(["error"=>"las fechas inicios  son iguales"],400);
                }

               }
               return response()->json(["succes"=>" papeleria consignacion creada"],201);
            }
            else if($validacion>0){
                return response()->json(["error"=>"ERROR"],400);
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
            ->select('fecha_inicio','id_plan_trabajo')
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
                        return response()->json(["error"=>'Las fechas inicio ya estan en esta actividad con este plan de trabajo'],400);
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
                    return response()->json(["error"=>"las fechas inicios  son iguales"],400);
                }

               }
               return response()->json(["succes"=>" formulas despachos creada"],201);
            }

            else if($validacion>0){
                return response()->json(["error"=>"ERROR"],400);
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
            ->select('fecha_inicio','id_plan_trabajo')
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
                        return response()->json(["error"=>'Las fechas inicio ya estan en esta actividad con este plan de trabajo'],400);
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
                    return response()->json(["error"=>"las fechas inicios  son iguales"],400);
                }

               }
               return response()->json(["succes"=>" actividad remision creada"],201);
            }
            else if($validacion>0){
                return response()->json(["error"=>"ERROR"],400);
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
                $tabla='condiciones_locativas';
                $id_plan_t=request('id_plan_trabajo');
                $fecha_ini=request('fecha_inicio');
//funcion que valida las fechas a insertar en la base de dato hay que colocar esta funcion en las actividades qe
//no son tan frecuentes y hay que hacer la funcion para os planes de trabajos que son frecuentes
        $respuesta=$this->validarQuenoExistanFechasRepetidadEnLaBase($tabla,$id_plan_t,$fecha_ini);


        if($respuesta>0){

            return response()->json (["error"=>"ya hay un registro con esta fecha de inicio en esta actividad y este plan de trabajo"],400);

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

                return response()->json(["succes"=>" Actividad documentacion legal creada"],201);
                }
                else{
                    return response()->json(["error"=>" fallaron las fechas"],400);

                }
        }



    }
}



