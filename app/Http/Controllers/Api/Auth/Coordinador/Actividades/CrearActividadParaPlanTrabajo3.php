<?php

namespace App\Http\Controllers\Api\Auth\Coordinador\Actividades;

use Illuminate\Http\Request;
use Laravel\Passport\Client;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Modelos\Actividades\LibroAgendasCliente;
use App\Modelos\Actividades\ConvenioExhibicion;
use App\Modelos\Actividades\RevisionCompletaInventarios;
use App\Modelos\Actividades\Excesos;
use App\Modelos\Actividades\LibroVencimientos;
use App\Modelos\Actividades\IngresoSucursal;





class CrearActividadParaPlanTrabajo3 extends Controller
{

    public function crearActividadLibroAgendaCliente(Request $request)
    {

        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required',
            'id_plan_trabajo'=>'required',
            'array_fechas_libro_agenda_cliente.*.fecha_inicio'=>'date_format:"Y-m-d"|required|date',
            'array_fechas_libro_agenda_cliente.*.fecha_fin'=>'date_format:"Y-m-d"|required|date'
        ]);
        if($validator->fails())
        {
          return response()->json( $errors=$validator->errors()->all() );
        }

        else
        {


            $fechas=request('array_fechas_libro_agenda_cliente');
            //codificacion a json
            $fechas_converter=json_encode($fechas,true);
            //decodificcion del reques recibido para iterar el aary
            $fechas_converter_d=json_decode($fechas_converter,true);


//consulta ala base de dato para traer todas las fechas de una actividad en un lan de trabajo especifico
            $fechas_base_datos=DB::table('libro_agendaclientes')
                        ->select('fecha_inicio','id_plan_trabajo','fecha_fin')
                        ->where('id_plan_trabajo',request('id_plan_trabajo'))
                        ->get();


           //isntancia de la funcion omnipotente para la validacion de las fechas establecida en Controller
               $validacion=$this->validarArrayFechas($fechas_converter_d);

              if($validacion==0)
              {
                  //se vuelve a iterrar el array para obtener los valores de las fechas i hacer las inserciones
                for($i=0; $i<sizeof($fechas_converter_d);$i++)
                {
                    //funcion que valida las fechas_inicio para que no esten repetidad en el array
                    $validacionFechas=$this->validarFechasInicioRepetido($fechas_converter_d);

                    if($validacionFechas==0){


                        //function para validar las fechas del array que valida que estas fechas no esten insertada en la base
                        // de dato en este mismo plan de rabajo y esta actividad  devolviendo las inserciones de la base de datos
                        //recibe 2 parametros el array de las fechas que se manda por el request  se encuentraa en Controller.php
                        $validacion_fecha_base=$this->validarFechasBaseDatoArray($fechas_converter_d,$fechas_base_datos);

                        if($validacion_fecha_base > 0){
                            return response()->json(["error"=>'ya existen  estas  fechas registrada en esta actividad con este plan de trabajo en la base de dato'],400);
                        }else{
                            $libroAgendaCliente =LibroAgendasCliente::create([

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
                return response()->json(["succes"=>"Actividad libro agenda cliente creada"],201);
              }
              elseif($validacion>0)
              {
                return response()->json(["error"=>"la fecha de inicio debe ser igual o mayor a la fecha actual y menor o igual a la fecha final"],400);
              }
            }
         }



         public function crearActividadConvenioExhibicion(Request $request){

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

                    $fechas_base_datos=DB::table('convenio_exhibicion')
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
                    $convenio_exhibicion =ConvenioExhibicion::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>request('id_prioridad'),
                        'estado' =>'Activo',

                    ]);
            }

                    // DB::commit();

                    return response()->json(["succes"=>" Actividad convenio exhibicion  creada"],201);

                }else{
                    return response()->json(["error"=>"las fechas inicio deben ser mayor o igual ala fecha actual y menor o igual a la fecha final"],400);

                }



            }

        }




        public function crearActividadExcesos(Request $request){

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


                    $fechas_base_datos=DB::table('excesos')
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
                    $excesos =Excesos::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>request('id_prioridad'),
                        'estado' =>'Activo',

                    ]);
            }

                    // DB::commit();

                    return response()->json(["succes"=>" Actividad Excesos creada"],201);

                }else{
                    return response()->json(["error"=>"  fechas incorrectas la fecha inicio debe ser mayor o igual ala actual y menor o igua a la final"],400);

                }



            }

        }

        public function crearActividadLibroVencimientos(Request $request){

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


                    $fechas_base_datos=DB::table('libro_vencimientos')
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
                    $libro_vencimiemto =LibroVencimientos::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>request('id_prioridad'),
                        'estado' =>'Activo',

                    ]);
            }

                    // DB::commit();

                    return response()->json(["succes"=>" Actividad Libro Vencimientos  creada"],201);

                }else{
                    return response()->json(["error"=>"  fechas incorrectas la fecha inicio debe ser mayor o igual ala actual y menor o igua a la final"],400);

                }



            }

        }

        public function crearActividadIngresoSucursal(Request $request){

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


                    $fechas_base_datos=DB::table('ingreso_sucursal')
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
                    $ingreso_sucursal =IngresoSucursal::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>request('id_prioridad'),
                        'estado' =>'Activo',

                    ]);
            }

                    // DB::commit();

                    return response()->json(["succes"=>" Actividad Ingreso Sucursal  creada"],201);

                }else{
                    return response()->json(["error"=>"  fechas incorrectas la fecha inicio debe ser mayor o igual ala actual y menor o igua a la final"],400);

                }



            }

        }
}