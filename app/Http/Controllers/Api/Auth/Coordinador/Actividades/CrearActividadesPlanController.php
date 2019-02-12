<?php

namespace App\Http\Controllers\Api\Auth\Coordinador\Actividades;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\Client;
use App\Modelos\Actividades\Apertura;
use App\Modelos\Actividades\ArqueoCaja;
use App\Modelos\Actividades\Domicilio;
use App\Modelos\Actividades\EnvioCorrespondencia;
use App\Modelos\Actividades\EvolucionClientes;
use App\Modelos\Actividades\ExamenGimed;
use App\Modelos\Actividades\Exhibiciones;
use App\Modelos\Actividades\Facturacion;
use App\Modelos\Actividades\Gimed;
use App\Modelos\Actividades\InventarioMercancia;
use App\Modelos\Actividades\Julienne;
use App\Modelos\Actividades\LibroVencimientos;
use App\Modelos\Actividades\ProductosBonificados;
use App\Modelos\Actividades\ProgramaMercadeo;
use App\Modelos\Actividades\RelacionServiciosPublicos;
use App\Modelos\Actividades\RelacionVendedores;
use App\Modelos\Actividades\ServicioBodega;
use App\Modelos\Actividades\UsoInstitucional;
use App\Modelos\Actividades\Detalles\Documentacion;
use App\Modelos\Actividades\Detalles\CondicionesDetalle;
use App\Modelos\Actividades\LibrosFaltantes;
use App\Modelos\Actividades\Kardex;
use App\Modelos\Actividades\Remisiones;

class CrearActividadesPlanController extends Controller
{
    public function crear_apertura(Request $request)
    {

        $validator=\Validator::make($request->all(),[
            // 'id_prioridad' => 'required|numeric',
            'id_plan_trabajo'=>'required|numeric',
            'fecha_inicio'=>'date_format:"Y-m-d"|required|date',
            'fecha_fin'=>'date_format:"Y-m-d"|required|date',

        ]);
        if($validator->fails())
        {
          return response()->json( $errors=$validator->errors()->all(),400);
        }

        else
        {
            $fecha= date('Y-m-d');

            if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){

                $fechas_base_datos=DB::table('apertura')
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


        //instancia del modelo documentacion legal para crear un registro de esta tabla
                $apertura =Apertura::create([

                    'id_plan_trabajo' =>request('id_plan_trabajo'),
                    'fecha_inicio' =>request('fecha_inicio'),
                    'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                    'observacion'=>'',
                    'id_prioridad' =>1,
                    'id_estado' =>1,

                ]);
        }

        return response()->json(["success"=>" Actividad  Apertura creada", 'id' => $apertura->id],201);
                }
                else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }


    }
    public function crear_documentacion_legal(Request $request){

        //imporante el id del plana detrabajo debe estar creado a la hora de crear las actividades a dicho plan de trabajo
    
        $validator=\Validator::make($request->all(),[
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
    
    
                $fechas_base_datos=DB::table('documentacion_legal')
                ->select('fecha_inicio','id_plan_trabajo','fecha_fin')
                ->where('id_plan_trabajo',request('id_plan_trabajo'))
                ->get();
    
                $fecha_ini=request('fecha_inicio');
                $fecha_finn=request('fecha_fin');
    
    
    
                $respuesta=$this->validarQuenoExistanFechasRepetidadEnLaBase($fechas_base_datos,$fecha_ini,$fecha_finn);
    
                if($respuesta>0){
    
                    return response()->json (["Ya existen estas fechas registradas en esta actividad con este plan de trabajo en la base de datos."],400);
                }else{
    
                    $documentacion_legal =DocumentacionLegal::create([
    
                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>1,
                        'id_estado' =>1,
    
                    ]);
                    if($documentacion_legal){
                        $documentos = DB::table('lista_documentacion_legal')
                        ->get();
    
                        foreach ($documentos as $documento) {
                            $documentacion =Documentacion::create([
                                'id_actividad' =>$documentacion_legal->id,
                                'id_documento' =>$documento->id,
                            ]);
                        }
                        return response()->json(["success"=>" Actividad  Apertura creada", 'id' => $documentacion_legal->id],201);
                    }else{
                        return response()->json(["success"=>"Actividad no encontrada o error al crearla."],400);
    
                    }
    
                }
    
    
    
            }else{
                return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);
    
            }
    
    
    
        }
    
    }
    public function crear_arqueo_caja(Request $request){

        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required|numeric',
            'id_plan_trabajo'=>'required|numeric',
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

                    $fechas_base_datos=DB::table('arqueo_caja')
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
                    $arqueo_caja =ArqueoCaja::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>request('id_prioridad'),
                        'id_estado' =>1,

                    ]);
            }

                    // DB::commit();

                    return response()->json(["success"=>" Actividad creada", 'id' => $arqueo_caja->id],201);

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }



            }
    }
    public function crear_kardex(Request $request){

        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required|numeric',
            'id_plan_trabajo'=>'required|numeric',
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
                        'id_prioridad' =>request('id_prioridad'),
                        'id_estado' =>1,

                    ]);
            }

                    // DB::commit();

                    return response()->json(["success"=>" Actividad creada", 'id' => $kardex->id],201);

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }



            }
    }
    public function crear_condiciones_locativas(Request $request){


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

            return response()->json (["Ya existen estas fechas registradas en esta actividad con este plan de trabajo en la base de datos."],400);

        }else{


        //instancia del modelo documentacion legal para crear un registro de esta tabla
                $condiciones_locativas =CondicionesLocativas::create([

                    'id_plan_trabajo' =>request('id_plan_trabajo'),
                    'fecha_inicio' =>request('fecha_inicio'),
                    'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                    'observacion'=>'',
                    'id_prioridad' =>request('id_prioridad'),
                    'id_estado' =>1,

                ]);
                if($condiciones_locativas){
                    $condiciones = DB::table('lista_condiciones_locativas')
                    ->get();

                    foreach ($condiciones as $condicion) {
                        $condicion =CondicionesDetalle::create([
                            'id_actividad' =>$condiciones_locativas->id,
                            'id_condicion' =>$condicion->id,
                        ]);
                    }
                }else{
                    return response()->json(["success"=>"Actividad no encontrada o error al crearla."],201);

                }
        }
                // DB::commit();
                return response()->json(["success"=>" Actividad condiciones locativas creada", 'id' => $condiciones_locativas->id],201);
                }
                else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
        }



    }
    public function crear_domicilios(Request $request){

        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required|numeric',
            'id_plan_trabajo'=>'required|numeric',
            'fecha_inicio'=>'date_format:"Y-m-d"|required|date',
            'fecha_fin'=>'date_format:"Y-m-d"|required|date',

        ]);
        if($validator->fails())
        {
          return response()->json( $errors=$validator->errors()->all(),400 );
        }

        else
        {
            $fecha= date('Y-m-d');

                if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){

                    $fechas_base_datos=DB::table('domicilios')
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
                    $domicilios =Domicilio::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>request('id_prioridad'),
                        'id_estado' =>1,

                    ]);
            }

                    return response()->json(["success"=>" Actividad creada", 'id' => $domicilios->id],201);

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }

            }
    }
    public function crear_envio_correspondencia(Request $request)
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

            $fecha= date('Y-m-d');

            if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){

                $fechas_base_datos=DB::table('envio_correspondencia')
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
                    $envio_correspondencia =EnvioCorrespondencia::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>request('id_prioridad'),
                        'id_estado' =>1,

                    ]);
            }

                    return response()->json(["success"=>" Actividad creada", 'id' => $envio_correspondencia->id],201);

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }


            }

    }
    public function crear_evolucion_clientes(Request $request){

        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required|numeric',
            'id_plan_trabajo'=>'required|numeric',
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

                    $fechas_base_datos=DB::table('evolucion_clientes')
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
                    $evolucion_pedido =EvolucionClientes::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>request('id_prioridad'),
                        'id_estado' =>1,

                    ]);
            }
                    return response()->json(["success"=>" Actividad creada", 'id' => $evolucion_pedido->id],201);

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }



            }
    }
    public function crear_examen_gimed(Request $request){

        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required|numeric',
            'id_plan_trabajo'=>'required|numeric',
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

                    $fechas_base_datos=DB::table('examen_gimed')
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
                    $examen_gimed =ExamenGimed::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>request('id_prioridad'),
                        'id_estado' =>1,

                    ]);
            }

                    // DB::commit();

                    return response()->json(["success"=>" Actividad creada", 'id' => $examen_gimed->id],201);

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }



            }
    }
    public function crear_exhibiciones(Request $request){

        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required|numeric',
            'id_plan_trabajo'=>'required|numeric',
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

                    $fechas_base_datos=DB::table('exhibiciones')
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
                    $exhibiciones =Exhibiciones::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>request('id_prioridad'),
                        'id_estado' =>1,

                    ]);
            }

                    return response()->json(["success"=>" Actividad creada", 'id' => $exhibiciones->id],201);

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }

            }
    }
    public function crear_facturacion(Request $request){

        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required|numeric',
            'id_plan_trabajo'=>'required|numeric',
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

                    $fechas_base_datos=DB::table('facturacion')
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
                    $facturacion =Facturacion::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>request('id_prioridad'),
                        'id_estado' =>1,

                    ]);
            }
                    return response()->json(["success"=>" Actividad creada", 'id' => $facturacion->id],201);

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }
    public function crear_gimed(Request $request){

        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required|numeric',
            'id_plan_trabajo'=>'required|numeric',
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

                    $fechas_base_datos=DB::table('gimed')
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
                    $gimed =Gimed::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>request('id_prioridad'),
                        'id_estado' =>1,

                    ]);
            }
                    return response()->json(["success"=>" Actividad creada", 'id' => $gimed->id],201);

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }
    public function crear_inventario_mercancia(Request $request){

        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required|numeric',
            'id_plan_trabajo'=>'required|numeric',
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

                    $fechas_base_datos=DB::table('inventario_mercancia')
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
                    $inventario_mercancia =InventarioMercancia::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>request('id_prioridad'),
                        'id_estado' =>1,

                    ]);
            }
                    return response()->json(["success"=>" Actividad creada", 'id' => $inventario_mercancia->id],201);

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }
    public function crear_julienne(Request $request){

        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required|numeric',
            'id_plan_trabajo'=>'required|numeric',
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

                    $fechas_base_datos=DB::table('julienne')
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
                    $julienne =Julienne::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>request('id_prioridad'),
                        'id_estado' =>1,

                    ]);
            }
                    return response()->json(["success"=>" Actividad creada", 'id' => $julienne->id],201);

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }
    public function crear_libro_vencimiento(Request $request){

        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required|numeric',
            'id_plan_trabajo'=>'required|numeric',
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

                    $fechas_base_datos=DB::table('libro_vencimiento')
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
                    $libro_vencimiento =LibroVencimientos::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>request('id_prioridad'),
                        'id_estado' =>1,

                    ]);
            }
                    return response()->json(["success"=>" Actividad creada", 'id' => $libro_vencimiento->id],201);

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }   
    public function crear_productos_bonificados(Request $request){

        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required|numeric',
            'id_plan_trabajo'=>'required|numeric',
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

                    $fechas_base_datos=DB::table('productos_bonificados')
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
                    $productos_bonificados =ProductosBonificados::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>request('id_prioridad'),
                        'id_estado' =>1,

                    ]);
            }
                    return response()->json(["success"=>" Actividad creada", 'id' => $productos_bonificados->id],201);

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }
    public function crear_programa_mercadeo(Request $request){

        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required|numeric',
            'id_plan_trabajo'=>'required|numeric',
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

                    $fechas_base_datos=DB::table('programa_mercadeo')
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
                    $programa_mercadeo =ProgramaMercadeo::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>request('id_prioridad'),
                        'id_estado' =>1,

                    ]);
            }
                    return response()->json(["success"=>" Actividad creada", 'id' => $programa_mercadeo->id],201);

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }
    public function crear_relacion_servicios_publicos(Request $request){

        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required|numeric',
            'id_plan_trabajo'=>'required|numeric',
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

                    $fechas_base_datos=DB::table('relacion_servicios_publicos')
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
                    $relacion_servicios_publicos =RelacionServiciosPublicos::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>request('id_prioridad'),
                        'id_estado' =>1,

                    ]);
            }
                    return response()->json(["success"=>" Actividad creada", 'id' => $relacion_servicios_publicos->id],201);

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }
    public function crear_relacion_vendedores(Request $request){

        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required|numeric',
            'id_plan_trabajo'=>'required|numeric',
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

                    $fechas_base_datos=DB::table('relacion_vendedores')
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
                    $relacion_vendedores =RelacionVendedores::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>request('id_prioridad'),
                        'id_estado' =>1,

                    ]);
            }
                    return response()->json(["success"=>" Actividad creada", 'id' => $relacion_vendedores->id],201);

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }
    public function crear_remisiones(Request $request){

        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required|numeric',
            'id_plan_trabajo'=>'required|numeric',
            'fecha_inicio'=>'date_format:"Y-m-d"|required|date',
            'fecha_fin'=>'date_format:"Y-m-d"|required|date',

        ]);
        if($validator->fails())
        {
          return response()->json( $errors=$validator->errors()->all(),400 );
        }

        else
        {
            $fecha= date('Y-m-d');

                if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){

                    $fechas_base_datos=DB::table('remisiones')
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
                    $remisiones =Remisiones::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>request('id_prioridad'),
                        'id_estado' =>1,

                    ]);
            }

                    return response()->json(["success"=>" Actividad creada", 'id' => $remisiones->id],201);

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }
    public function crear_servicio_bodega(Request $request){

        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required|numeric',
            'id_plan_trabajo'=>'required|numeric',
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

                    $fechas_base_datos=DB::table('servicio_bodega')
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
                    $servicio_bodega =ServicioBodega::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>request('id_prioridad'),
                        'id_estado' =>1,

                    ]);
            }
                    return response()->json(["success"=>" Actividad creada", 'id' => $relacion_vendedores->id],201);

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }
    public function crear_uso_institucional(Request $request){

        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required|numeric',
            'id_plan_trabajo'=>'required|numeric',
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

                    $fechas_base_datos=DB::table('uso_institucional')
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
                    $uso_institucional =UsoInstitucional::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>request('id_prioridad'),
                        'id_estado' =>1,

                    ]);
            }
                    return response()->json(["success"=>" Actividad creada", 'id' => $uso_institucional->id],201);

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }
    public function crear_libros_faltantes(Request $request){

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
                        'id_estado' =>1,

                    ]);
            }

                    return response()->json(["success"=>"Actividad creada", 'id' => $libro_faltantes->id],201);

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }
    public function crear_ptc(Request $request){

        //imporante el id del plana detrabajo debe estar creado a la hora de crear las actividades a dicho plan de trabajo

        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required|numeric',
            'titulo' => 'required',
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
                
                $ptc =ActividadPtc::create([

                    'id_plan_trabajo' =>request('id_plan_trabajo'),
                    'titulo' =>request('titulo'),
                    'fecha_inicio' =>request('fecha_inicio'),
                    'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                    'observacion'=>'',
                    'id_prioridad' =>request('id_prioridad'),
                    'id_estado' =>1,

                ]);
        
                // DB::commit();

                return response()->json(["success"=>" Actividad Ptc creada", 'id' => $ptc->id],201);

            }else{
                return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

            }

        }

    }
}
