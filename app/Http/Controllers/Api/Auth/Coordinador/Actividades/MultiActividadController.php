<?php

namespace App\Http\Controllers\Api\Auth\Coordinador\Actividades;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modelos\Actividades\Apertura;
use App\Modelos\Actividades\CondicionesLocativas;
use App\Modelos\Actividades\PapeleriaConsignaciones;
use App\Modelos\Actividades\FormulasDespachos;
use App\Modelos\Actividades\Remisiones;
use App\Modelos\Actividades\Kardex;
use App\Modelos\Actividades\CapturaClientes;
use App\Modelos\Actividades\ConvenioExhibicion;
use App\Modelos\Actividades\EvaluacionPedidos;
use App\Modelos\Actividades\Excesos;
use App\Modelos\Actividades\IngresoSucursal;
use App\Modelos\Actividades\LibroAgendasCliente;
use App\Modelos\Actividades\LibrosFaltantes;
use App\Modelos\Actividades\LibroVencimientos;
use App\Modelos\Actividades\PresupuestoPedidos;
use App\Modelos\Actividades\RevisionCompletaInventarios;
use App\Modelos\Actividades\SeguimientoVendedor;
use App\Modelos\Actividades\DocumentacionLegal;
use App\Modelos\Notificaciones;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class MultiActividadController extends Controller
{
    public function apertura(Request $request)
    {

        $validator=\Validator::make($request->all(),[
            // 'id_prioridad' => 'required|numeric',
            
            'id_plan_trabajo'=>'required|numeric',
            'array_fechas.*.fecha_inicio'=>'date_format:"Y-m-d"|required|date',

        ]);
        if($validator->fails())
        {
          return response()->json( $errors=$validator->errors()->all(),400);
        }

        else
        {
            $id_planT=request('id_plan_trabajo');

            $fechas=request('array_fechas');
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
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual."],400);
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
                    return response()->json(["Las fechas iniciales no puede ser iguales."],400);
                }

                if($sw2>0){

                    return response()->json(["Ya existen estas fechas registradas en esta actividad con este plan de trabajo en la base de datos."],400);

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


               }else{

                return response()->json(["Este plan trabajo no existe."],400);
               }




            }


    }

    public function documentacion_legal(Request $request){

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

    public function papeleria_consignaciones(Request $request){

        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required|numeric',

            'id_plan_trabajo'=>'required|numeric',
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
                        return response()->json (["Ya existen estas fechas registradas en esta actividad con este plan de trabajo en la base de datos."],400);
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
                    return response()->json(["La fecha inicial y fecha final no pueden ser iguales"],400);
                }

               }
               return response()->json(["success"=>" papeleria consignacion creada", 'id' => $papeleria->id],201);
            }
            else if($validacion>0){
                return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);
            }



            }

    }

    public function formulas_despachos(Request $request){

        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required|numeric',

            'id_plan_trabajo'=>'required|numeric',
            'array_fechas.*.fecha_inicio'=>'date_format:"Y-m-d"|required|date',
            'array_fechas.*.fecha_fin'=>'date_format:"Y-m-d"|required|date',

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
                        return response()->json (["Ya existen estas fechas registradas en esta actividad con este plan de trabajo en la base de datos."],400);
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
                    return response()->json(["La fecha inicial o fecha final no pueden ser iguales por registros diferentes."],400);
                }

               }
               return response()->json(["success"=>" formulas despachos creada", 'id'=>$formulas->id],201);
            }

            else if($validacion>0){
                return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);
            }


            }


    }

    public function remisiones(Request $request){



        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required|numeric',

            'id_plan_trabajo'=>'required|numeric',
            'array_fechas.*.fecha_inicio'=>'date_format:"Y-m-d"|required|date',
            'array_fechas.*.fecha_fin'=>'date_format:"Y-m-d"|required|date',

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
                        return response()->json (["Ya existen estas fechas registradas en esta actividad con este plan de trabajo en la base de datos."],400);
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
                    return response()->json(["La fecha inicial o fecha final no pueden ser iguales por registros diferentes."],400);
                }

               }
               return response()->json(["success"=>" actividad remision creada", 'id' => $remisiones->id],201);
            }
            else if($validacion>0){
                return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);
            }

            }

    }

    public function condiciones_locativas(Request $request){


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

    public function kardex(Request $request){

        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required',
            'id_plan_trabajo'=>'required',
            'laboratorios'=>'required',
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
                            return response()->json (["Ya existen estas fechas registradas en esta actividad con este plan de trabajo en la base de datos."],400);
                        }else{

                $kardex =Kardex::create([

                    'id_plan_trabajo' =>request('id_plan_trabajo'),
                    'fecha_inicio' =>$fechas_converter_d[$i]["fecha_inicio"],
                    'fecha_fin' =>$fechas_converter_d[$i]["fecha_fin"]." "."23:59:00",
                    'laboratorios_asignados'=>request('laboratorios'),
                    'observacion'=>'',
                    'id_prioridad' =>request('id_prioridad'),
                    'estado' =>'Activo',

                ]);
                        }
                    }else{
                        return response()->json(["Las fecha inicial y fecha final no pueden ser iguales"],400);
                    }
                 }
                return response()->json(["success"=>"Actividad Kardex creada", 'id' => $kardex->id],201);
              }
              elseif($validacion>0)
              {
                return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);
              }
            }
    }

    public function seguimiento_vendedores(Request $request){



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
                        return response()->json(["La fecha inicial o fecha final no pueden ser iguales por registros diferentes."],400);
                    }


                }
                return response()->json(["success"=>"Actividad Seguimiento vendedores creada", 'id' => $seguimiento_vendedor->id],201);
              }
              elseif($validacion>0)
              {
                return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);
              }
            }


    }

    public function evaluacion_pedidos(Request $request){

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

    public function presupuesto_pedido(Request $request){

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

    public function libros_faltantes(Request $request){

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
                            return response()->json (["Ya existen estas fechas registradas en esta actividad con este plan de trabajo en la base de datos."],400);
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
                        return response()->json(["La fecha inicial o fecha final no pueden ser iguales por registros diferentes."],400);
                    }
                 }
                return response()->json(["success"=>"Actividad libros faltantes creada", 'id'=>$libro_faltantes->id],201);
              }
              elseif($validacion>0)
              {
                return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);
              }
            }
    }

    public function captura_cliente(Request $request){

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

        //instncia del modelo documentacion legal para crear un registro de esta tabla

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

    public function libro_agendacliente(Request $request){

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
                            return response()->json (["Ya existen estas fechas registradas en esta actividad con este plan de trabajo en la base de datos."],400);
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
                        return response()->json(["La fecha inicial o fecha final no pueden ser iguales por registros diferentes."],400);
                    }
                 }
                return response()->json(["success"=>"Actividad libro agenda cliente creada", 'id' => $libroAgendaCliente->id],201);
              }
              elseif($validacion>0)
              {
                return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);
              }
            }
    }

    public function convenio_exhibicion(Request $request){

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

            return response()->json (["Ya existen estas fechas registradas en esta actividad con este plan de trabajo en la base de datos."],400);

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

                return response()->json(["success"=>" Actividad convenio exhibicion  creada", 'id' => $convenio_exhibicion->id],201);

            }else{
                return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

            }



        }

    }

    public function excesos(Request $request){

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

            return response()->json (["Ya existen estas fechas registradas en esta actividad con este plan de trabajo en la base de datos."],400);

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

                return response()->json(["success"=>" Actividad Excesos creada", 'id' => $excesos->id],201);

            }else{
                return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

            }



        }

    }

    public function libro_vencimientos(Request $request){

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
            return response()->json (["Ya existen estas fechas registradas en esta actividad con este plan de trabajo en la base de datos."],400);

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

                return response()->json(["success"=>" Actividad Libro Vencimientos creada", 'id' => $libro_vencimiemto->id],201);

            }else{
                return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

            }



        }

    }

    public function ingreso_sucursal(Request $request){

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

            return response()->json (["Ya existen estas fechas registradas en esta actividad con este plan de trabajo en la base de datos."],400);

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

                return response()->json(["success"=>" Actividad Ingreso Sucursal creada", 'id' => $ingreso_sucursal->id],201);

            }else{
                return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

            }
        }

    }

}
