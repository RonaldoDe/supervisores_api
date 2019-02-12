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
            'laboratorios'=>'required',
            'fecha_inicio'=>'date_format:"Y-m-d"|required|date',
            'fecha_fin'=>'date_format:"Y-m-d"|required|date'
        ]);
        if($validator->fails())
        {
          return response()->json( $errors=$validator->errors()->all(),400 );
        }

        else
        {

            $fecha= date('Y-m-d');

                if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){

                    $fechas_base_datos=DB::table('kardex')
                ->select('fecha_inicio','id_plan_trabajo','fecha_fin')
                ->where('id_plan_trabajo',request('id_plan_trabajo'))
                ->get();

            $fecha_ini=request('fecha_inicio');
            $fecha_finn=request('fecha_fin');
            //funcion que valida las fechas a insertar en la base de dato hay que colocar esta funcion en las actividades qe
            //no son tan frecuentes y hay que hacer la funcion para os planes de trabajos que son frecuentes
            $respuesta=$this->validarQuenoExistanFechasRepetidadEnLaBase($fechas_base_datos,$fecha_ini,$fecha_finn);


            if($respuesta>0){

                return response()->json (["Ya existen estas fechas registradas en esta actividad con este plan de trabajo en la base de datos."],400);

            }else{
                    $kardex =Kardex::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'laboratorios_asignados' => request('laboratorios'),
                        'id_prioridad' =>request('id_prioridad'),
                        'estado' =>'Activo',

                    ]);
            }

                    // DB::commit();

                    return response()->json(["success"=>" Actividad creada", 'id' => $kardex->id],201);

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }

            }
         }



         public function crearActividadSeguimientoVendedor(Request $request){



            $validator=\Validator::make($request->all(),[
                'id_prioridad' => 'required',
                'id_plan_trabajo'=>'required',
                'fecha_inicio'=>'date_format:"Y-m-d"|required|date',
                'fecha_fin'=>'date_format:"Y-m-d"|required|date'
            ]);
            if($validator->fails())
            {
              return response()->json( $errors=$validator->errors()->all(),400 );
            }

            else
            {
                $fecha= date('Y-m-d');

                if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){

                    $fechas_base_datos=DB::table('seguimiento_vendedores')
                ->select('fecha_inicio','id_plan_trabajo','fecha_fin')
                ->where('id_plan_trabajo',request('id_plan_trabajo'))
                ->get();

            $fecha_ini=request('fecha_inicio');
            $fecha_finn=request('fecha_fin');
//funcion que valida las fechas a insertar en la base de dato hay que colocar esta funcion en las actividades qe
//no son tan frecuentes y hay que hacer la funcion para os planes de trabajos que son frecuentes
            $respuesta=$this->validarQuenoExistanFechasRepetidadEnLaBase($fechas_base_datos,$fecha_ini,$fecha_finn);


            if($respuesta>0){

                return response()->json (["Ya existen estas fechas registradas en esta actividad con este plan de trabajo en la base de datos."],400);

            }else{
                    $seguimiento_vendedores =SeguimientoVendedor::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>request('id_prioridad'),
                        'estado' =>'Activo',

                    ]);
            }

                    // DB::commit();

                    return response()->json(["success"=>" Actividad creada", 'id' => $seguimiento_vendedores->id],201);

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

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

                return response()->json (["Ya existen estas fechas registradas en esta actividad con este plan de trabajo en la base de datos."],400);

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


                    return response()->json(["success"=>" Actividad Evaluacion Pedidos  creada", 'id' => $evaluacionPedidos->id],201);

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

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

                        return response()->json (["Ya existen estas fechas registradas en esta actividad con este plan de trabajo en la base de datos."],400);

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


                    return response()->json(["success"=>" Actividad Presupuesto pedidos creada", 'id' => $evaluacionPedidos->id],201);

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }



            }

        }


    public function crearActividadLibrosFaltantes(Request $request)
    {

        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required',
            'id_plan_trabajo'=>'required',
            'fecha_inicio'=>'date_format:"Y-m-d"|required|date',
            'fecha_fin'=>'date_format:"Y-m-d"|required|date'
        ]);
        if($validator->fails())
        {
          return response()->json( $errors=$validator->errors()->all(),400 );
        }

        else
        {


            $fecha= date('Y-m-d');

                if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){

                    $fechas_base_datos=DB::table('libros_faltantes')
                ->select('fecha_inicio','id_plan_trabajo','fecha_fin')
                ->where('id_plan_trabajo',request('id_plan_trabajo'))
                ->get();

            $fecha_ini=request('fecha_inicio');
            $fecha_finn=request('fecha_fin');
            //funcion que valida las fechas a insertar en la base de dato hay que colocar esta funcion en las actividades qe
            //no son tan frecuentes y hay que hacer la funcion para os planes de trabajos que son frecuentes
            $respuesta=$this->validarQuenoExistanFechasRepetidadEnLaBase($fechas_base_datos,$fecha_ini,$fecha_finn);


            if($respuesta>0){

                return response()->json (["Ya existen estas fechas registradas en esta actividad con este plan de trabajo en la base de datos."],400);

            }else{
                    $libro_faltantes =LibrosFaltantes::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>request('id_prioridad'),
                        'estado' =>'Activo',

                    ]);
            }

                    return response()->json(["success"=>"Actividad creada", 'id' => $libro_faltantes->id],201);

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

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

                return response()->json (["Ya existen estas fechas registradas en esta actividad con este plan de trabajo en la base de datos."],400);

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

                    return response()->json(["success"=>" Actividad  Captura Cliente  creada", 'id' => $captura_cliente->id],201);

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }



            }


              }





}

