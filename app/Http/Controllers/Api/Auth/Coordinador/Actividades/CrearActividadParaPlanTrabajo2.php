<?php

namespace App\Http\Controllers\Api\Auth\Coordinador\Actividades;

use Illuminate\Http\Request;
use Laravel\Passport\Client;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Modelos\Actividades\Kardex;
use App\Modelos\Actividades\SeguimientoVendedor;
use App\Modelos\Actividades\EvaluacionPedidos;
use App\Modelos\Actividades\PresupuestoPedidos;
use App\Modelos\Actividades\LibrosFaltantes;
use App\Modelos\Actividades\CapturaClientes;

class CrearActividadParaPlanTrabajo2 extends Controller
{

    public function crearActividadAKardex(Request $request)
    {

        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required',
            'id_plan_trabajo'=>'required',
            'array_fechas.*.fecha_inicio'=>'date_format:"Y-m-d"|required|date',
            'array_fechas.*.fecha_fin'=>'date_format:"Y-m-d"|required|date'
        ]);
        if($validator->fails())
        {
          return response()->json( $errors=$validator->errors()->all(),400 );
        }

        else
        {


            $fechas=request('array_fechas');
            //codificacion a json
            $fechas_converter=json_encode($fechas,true);
            //decodificcion del reques recibido para iterar el aary
            $fechas_converter_d=json_decode($fechas_converter,true);


            $fechas_base_datos=DB::table('kardex')
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

                        $validacion_fecha_base=$this->validarFechasBaseDatoArray($fechas_converter_d,$fechas_base_datos);

                        if($validacion_fecha_base > 0){
                            return response()->json(["error"=>'ya existen  estas  fechas registrada en esta actividad con este plan de trabajo en la base de dato'],400);
                        }else{

                $kardex =Kardex::create([

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
                return response()->json(["succes"=>"Actividad Kardex creada", 'id' => $kardex->id],201);
              }
              elseif($validacion>0)
              {
                return response()->json(["error"=>"la fecha de inicio debe ser igual o mayor a la fecha actual y menor o igual a la fecha final"],400);
              }
            }
         }



         public function crearActividadSeguimientoVendedor(Request $request){



            $validator=\Validator::make($request->all(),[
                'id_prioridad' => 'required',
                'id_plan_trabajo'=>'required',
                'array_fechas.*.fecha_inicio'=>'date_format:"Y-m-d"|required|date',
                'array_fechas.*.fecha_fin'=>'date_format:"Y-m-d"|required|date'
            ]);
            if($validator->fails())
            {
              return response()->json( $errors=$validator->errors()->all(),400 );
            }

            else
            {
                $fechas=request('array_fechas');
                //codificacion a json
                $fechas_converter=json_encode($fechas,true);
                //decodificcion del reques recibido para iterar el aary
                $fechas_converter_d=json_decode($fechas_converter,true);

                $fechas_base_datos=DB::table('seguimiento_vendedores')
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
                        //funcion que valida que las fechas de inicio no sean iguales
                        $validacionFechas=$this->validarFechasInicioRepetido($fechas_converter_d);

                        if($validacionFechas==0){

                            $validacion_fecha_base=$this->validarFechasBaseDatoArray($fechas_converter_d,$fechas_base_datos);

                            if($validacion_fecha_base > 0){
                                return response()->json(["error"=>'ya existen  estas  fechas registrada en esta actividad con este plan de trabajo en la base de dato '],400);
                            }else{

                            $seguimiento_vendedor =SeguimientoVendedor::create([

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
                    return response()->json(["succes"=>"Actividad Seguimiento vendedores creada", 'id' => $seguimiento_vendedor->id],201);
                  }
                  elseif($validacion>0)
                  {
                    return response()->json(["error"=>"fechas inicio deben ser mayores o iguales a la fecha actual y la fecha fin debe ser mayor o igual ala inicial"],400);
                  }
                }


        }

        public function crearActividadEvaluacionPedidos(Request $request){

            //imporante el id del plana detrabajo debe estar creado a la hora de crear las actividades a dicho plan de trabajo

            $validator=\Validator::make($request->all(),[
                'id_prioridad' => 'required|numeric',
                'id_plan_trabajo'=>'required|numeric',
                'fecha_inicio'=>'date_format:"Y-m-d"|required',
                'fecha_fin'=>'date_format:"Y-m-d"|required'

            ]);
            if($validator->fails())
            {
              return response()->json( $errors=$validator->errors()->all(),400 );
            }

            else
            {



        //instancia del modelo documentacion legal para crear un registro de esta tabla

                $fecha= date('Y-m-d');

                if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){

                    $fechas_base_datos=DB::table('evaluacion_pedidos')
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
                    $evaluacionPedidos =EvaluacionPedidos::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>request('id_prioridad'),
                        'estado' =>'Activo',

                    ]);
            }


                    return response()->json(["succes"=>" Actividad Evaluacion Pedidos  creada", 'id' => $evaluacionPedidos->id],201);

                }else{
                    return response()->json(["error"=>"las fechas inicio deben ser mayor o igual ala fecha actual y menor o igual a la fecha final"],400);

                }



            }

        }


        public function crearActividadPresupuestoPedidos(Request $request){

            //imporante el id del plana detrabajo debe estar creado a la hora de crear las actividades a dicho plan de trabajo

            $validator=\Validator::make($request->all(),[
                'id_prioridad' => 'required|numeric',
                'id_plan_trabajo'=>'required|numeric',
                'fecha_inicio'=>'date_format:"Y-m-d"|required',
                'fecha_fin'=>'date_format:"Y-m-d"|required'

            ]);
            if($validator->fails())
            {
              return response()->json( $errors=$validator->errors()->all(),400 );
            }

            else
            {





                $fecha= date('Y-m-d');

                if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){


                    $fechas_base_datos=DB::table('presupuesto_pedido')
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

                        $evaluacionPedidos =PresupuestoPedidos::create([

                            'id_plan_trabajo' =>request('id_plan_trabajo'),
                            'fecha_inicio' =>request('fecha_inicio'),
                            'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                            'observacion'=>'',
                            'id_prioridad' =>request('id_prioridad'),
                            'estado' =>'Activo',

                        ]);

                    }


                    return response()->json(["succes"=>" Actividad Presupuesto pedidos creada", 'id' => $evaluacionPedidos->id],201);

                }else{
                    return response()->json(["error"=>" las fechas inicio deben ser mayor o igual ala fecha actual y menor o igual a la fecha final"],400);

                }



            }

        }


    public function crearActividadLibrosFaltantes(Request $request)
    {

        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required',
            'id_plan_trabajo'=>'required',
            'array_fechas.*.fecha_inicio'=>'date_format:"Y-m-d"|required|date',
            'array_fechas.*.fecha_fin'=>'date_format:"Y-m-d"|required|date'
        ]);
        if($validator->fails())
        {
          return response()->json( $errors=$validator->errors()->all(),400 );
        }

        else
        {


            $fechas=request('array_fechas');
            //codificacion a json
            $fechas_converter=json_encode($fechas,true);
            //decodificcion del reques recibido para iterar el aary
            $fechas_converter_d=json_decode($fechas_converter,true);


            $fechas_base_datos=DB::table('libros_faltantes')
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

                        $validacion_fecha_base=$this->validarFechasBaseDatoArray($fechas_converter_d,$fechas_base_datos);

                        if($validacion_fecha_base > 0){
                            return response()->json(["error"=>'ya existen  estas  fechas registrada en esta actividad con este plan de trabajo en la base de dato'],400);
                        }else{




                $libro_faltantes =LibrosFaltantes::create([

                    'id_plan_trabajo' =>request('id_plan_trabajo'),
                    'fecha_inicio' =>$fechas_converter_d[$i]["fecha_inicio"],
                    'fecha_fin' =>$fechas_converter_d[$i]["fecha_fin"]." "."23:59:00",
                    // 'observacion'=>'',
                    'id_prioridad' =>request('id_prioridad'),
                    'estado' =>'Activo',

                ]);
                        }
                    }else{
                        return response()->json(["error"=>"las fechas inicios o fechas  finales no pueden ser  iguales por registros diferentes"],400);
                    }
                 }
                return response()->json(["succes"=>"Actividad libros faltantes creada", 'id'=>$libro_faltantes->id],201);
              }
              elseif($validacion>0)
              {
                return response()->json(["error"=>"la fecha de inicio debe ser igual o mayor a la fecha actual y menor o igual a la fecha final"],400);
              }
            }
         }

         public function crearActividadCapturaClientes(Request $request)
         {


            $validator=\Validator::make($request->all(),[
                'id_prioridad' => 'required|numeric',
                'id_plan_trabajo'=>'required|numeric',
                'fecha_inicio'=>'date_format:"Y-m-d"|required',
                'fecha_fin'=>'date_format:"Y-m-d"|required'

            ]);
            if($validator->fails())
            {
              return response()->json( $errors=$validator->errors()->all(),400 );
            }

            else
            {



        //instancia del modelo documentacion legal para crear un registro de esta tabla

                $fecha= date('Y-m-d');

                if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){

                    $fechas_base_datos=DB::table('captura_cliente')
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
                    $captura_cliente =CapturaClientes::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>request('id_prioridad'),
                        'estado' =>'Activo',

                    ]);
            }

                    // DB::commit();

                    return response()->json(["succes"=>" Actividad  Captura Cliente  creada", 'id' => $captura_cliente->id],201);

                }else{
                    return response()->json(["error"=>"la fecha de inicio debe ser igual o mayor a la fecha actual y menor o igual a la fecha final"],400);

                }



            }


              }





}

