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
use App\Modelos\Actividades\Detalles\Documentacion;
use App\Modelos\Actividades\CondicionesLocativas;
use App\Modelos\Actividades\Detalles\CondicionesDetalle;
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
            'fecha_inicio'=>'date_format:"Y-m-d"|required',
            'fecha_fin'=>'date_format:"Y-m-d"|required'

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
                    $apertura =Apertura::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' => 1,
                        'estado' =>'Activo',

                    ]);
            }

                    // DB::commit();

                    return response()->json(["success"=>" Actividad  Apertura creada", 'id' => $apertura->id],201);

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }



            }


    }



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
                    'id_prioridad' =>request('id_prioridad'),
                    'estado' =>'Activo',

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
                }else{
                    return response()->json(["success"=>"Actividad no encontrada o error al crearla."],201);

                }

                return response()->json(["success"=>" Actividad documentacion legal creada", 'id' => $documentacion_legal->id],201);
            }



        }else{
            return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

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

                    $fechas_base_datos=DB::table('papeleria_consignaciones')
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
                    $papeleria_consignaciones =PapeleriaConsignaciones::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>request('id_prioridad'),
                        'estado' =>'Activo',

                    ]);
            }

                    // DB::commit();

                    return response()->json(["success"=>" Actividad creada", 'id' => $papeleria_consignaciones->id],201);

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }



            }
    }

    public function crearActividadFormulaDespachos(Request $request){

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

                    $fechas_base_datos=DB::table('formulas_despachos')
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
                    $formulas_despacho =FormulasDespachos::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>request('id_prioridad'),
                        'estado' =>'Activo',

                    ]);
            }

                    // DB::commit();

                    return response()->json(["success"=>" Actividad creada", 'id' => $formulas_despacho->id],201);

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }



            }


    }

    public function crearActividadRemisiones(Request $request){



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
                        'estado' =>'Activo',

                    ]);
            }

                    // DB::commit();

                    return response()->json(["success"=>" Actividad creada", 'id' => $remisiones->id],201);

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

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
                    'estado' =>'Activo',

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
}



