<?php

namespace App\Http\Controllers\Api\Auth\Coordinador\Actividades;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Modelos\Actividades\Apertura;
use App\Modelos\Actividades\DocumentacionLegal;
use App\Modelos\Actividades\PapeleriaConsignaciones;
use App\Modelos\Actividades\FormulasDespachos;
use App\Modelos\Actividades\Remisiones;
use App\Modelos\Actividades\CondicionesLocativas;
use App\Modelos\Actividades\Kardex;
use App\Modelos\Actividades\SeguimientoVendedor;
use App\Modelos\Actividades\EvaluacionPedidos;
use App\Modelos\Actividades\PresupuestoPedidos;
use App\Modelos\Actividades\LibrosFaltantes;
use App\Modelos\Actividades\CapturaClientes;
use App\Modelos\Actividades\LibroAgendasCliente;
use App\Modelos\Actividades\Excesos;
use App\Modelos\Actividades\LibroVencimientos;
use App\Modelos\Actividades\IngresoSucursal;

class UpdateActividadesController extends Controller
{
    public function updateActividadApertura(Request $request)
    {

        $validator=\Validator::make($request->all(),[
            // 'id_prioridad' => 'required|numeric',
            
            'id_plan_trabajo'=>'required|numeric',
            'id_actividad'=>'required',
            'array_fechas.*.fecha_inicio'=>'date_format:"Y-m-d"|required|date',

        ]);
        if($validator->fails())
        {
          return response()->json( $errors=$validator->errors()->all());
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
                    return response()->json("las fechas inicio deben ser mayor o igual ala fecha actual ",400);
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
                    return response()->json("las fechas inicios  no pueden ser  iguales ",400);
                }

                if($sw2>0){

                    return response()->json('ya existen  estas  fechas registrada en esta actividad con este plan de trabajo en la base de dato ',400);

                }else{

                    for($i=0;$i<sizeof($fechas_converter_d);$i++){

                        $actividad = Apertura::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
                        if($actividad!= null){
                            $actividad->fecha_inicio = $fechas_converter_d[$i]["fecha_inicio"];
                            $actividad->fecha_fin = $fechas_converter_d[$i]["fecha_inicio"]." "."23:59:00";
                            $actividad->estado = 'Activo';
                            $actividad->update();
                            return response()->json('Actividad actualizada con exito');
                        }
                        return response()->json('Error Actividad no encontrada');
                   
                }
                    return response()->json("Array error",201);
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
            //             return response()->json('ya existen  estas  fechas registrada en esta actividad con este plan de trabajo en la base de dato '],400);
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
            //         return response()->json("las fechas inicios o fechas  finales no pueden ser  iguales "],400);
            //     }

            //    }
            //    return response()->json(["succes"=>"Actividad Apertura creada"],201);
            // }

            // else if($validacion>0){
            //     return response()->json("las fechas inicio deben ser mayor o igual ala fecha actual y menor o igual a la feca final"],400);
            // }

               }else{

                return response()->json("error este plan trabajo no existe",400);
               }

            }
    }
    public function updateActividadDocumentacionLegal(Request $request){

        //imporante el id del plana detrabajo debe estar creado a la hora de crear las actividades a dicho plan de trabajo
    
        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required|numeric',
            'id_plan_trabajo'=>'required|numeric',
            'id_actividad'=>'required',
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
    
                    return response()->json ("ya existen  estas  fechas registrada en esta actividad con este plan de trabajo en la base de dato ",400);
                }else{
                    
                    $actividad = DocumentacionLegal::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
                        if($actividad!= null){
                            $actividad->fecha_inicio = request('fecha_inicio');
                            $actividad->fecha_fin = request('fecha_fin').' '.'23:59:00';
                            $actividad->estado = 'Activo';
                            $actividad->id_prioridad = request('id_prioridad');
                            $actividad->update();
                            return response()->json('Actividad actualizada con exito');
                        }
                        return response()->json('Error Actividad no encontrada');
                }
    
        
            }else{
                return response()->json("las fechas inicio deben ser mayor o igual ala fecha actual y menor o igual a la fecha final",400);
    
            }
    
    
    
        }
    
    }
    //actualiza la actividad paeleria consignacion para la perte de los coordinadores
    public function updateActividadPapeleriaConsignaciones(Request $request){

        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required|numeric',
            'id_actividad' => 'required',
            'id_plan_trabajo'=>'required|numeric',
            'array_fechas.*.fecha_inicio'=>'date_format:"Y-m-d"|required|date',
            'array_fechas.*.fecha_fin'=>'date_format:"Y-m-d"|required|date'
        ]);
        if($validator->fails())
        {
          return response()->json( $errors=$validator->errors()->all() );
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
                        return response()->json('ya existen  estas  fechas registrada en esta actividad con este plan de trabajo en la base de dato ',400);
                    }else{
                        $actividad = PapeleriaConsignaciones::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
                        if($actividad!= null){
                            $actividad->fecha_inicio = $fechas_converter_d[$i]["fecha_inicio"];
                            $actividad->fecha_fin = $fechas_converter_d[$i]["fecha_fin"]." "."23:59:00";
                            $actividad->estado = 'Activo';
                            $actividad->id_prioridad = request('id_prioridad');
                            $actividad->update();
                            return response()->json('Actividad actualizada con exito',200);
                        }
                        return response()->json('Error Actividad no encontrada',400);

                    }
                }else{
                    return response()->json("las fechas inicios o fechas  finales no pueden ser  iguales",400);
                }

               }
            }
            else if($validacion>0){
                return response()->json("las fechas inicio deben ser mayor o igual ala fecha actual y menor o igual a la fecha final",400);
            }



            }

    }    
    //actualiza la actividad formulas despacho para la perte de los coordinadores
    public function updateActividadFormulaDespachos(Request $request){

        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required|numeric',
            'id_actividad' => 'required',
            'id_plan_trabajo'=>'required|numeric',
            'array_fechas.*.fecha_inicio'=>'date_format:"Y-m-d"|required|date',
            'array_fechas.*.fecha_fin'=>'date_format:"Y-m-d"|required|date'

        ]);
        if($validator->fails())
        {
          return response()->json( $errors=$validator->errors()->all() );
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
                        return response()->json('ya existen  estas  fechas registrada en esta actividad con este plan de trabajo en la base de dato',400);
                    }else{
                        $actividad = FormulasDespachos::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
                        if($actividad!= null){
                            $actividad->fecha_inicio = $fechas_converter_d[$i]["fecha_inicio"];
                            $actividad->fecha_fin = $fechas_converter_d[$i]["fecha_fin"]." "."23:59:00";
                            $actividad->estado = 'Activo';
                            $actividad->id_prioridad = request('id_prioridad');
                            $actividad->update();
                            return response()->json('Actividad actualizada con exito', 200);
                        }else{
                            return response()->json('Actividad no encontrada',400);
                        }
                    }
                }else{
                    return response()->json("las fechas inicios o fechas  finales no pueden ser  iguales por registros diferentes",400);
                }

               }
               return response()->json("Error de servidor",500);
            }

            else if($validacion>0){
                return response()->json("las fechas inicio deben ser mayor o igual ala fecha actual y menor o igual a la fecha final",400);
            }
            }


    }
    public function updateActividadRemisiones(Request $request){



        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required|numeric',
            'id_actividad' => 'required',
            'id_plan_trabajo'=>'required|numeric',
            'array_fechas.*.fecha_inicio'=>'date_format:"Y-m-d"|required|date',
            'array_fechas.*.fecha_fin'=>'date_format:"Y-m-d"|required|date'



        ]);
        if($validator->fails())
        {
          return response()->json( $errors=$validator->errors()->all() );
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
                        return response()->json('ya existen  estas  fechas registrada en esta actividad con este plan de trabajo en la base de dato',400);
                    }else{
                        $actividad = Remisiones::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
                        if($actividad!= null){
                            $actividad->fecha_inicio = $fechas_converter_d[$i]["fecha_inicio"];
                            $actividad->fecha_fin = $fechas_converter_d[$i]["fecha_fin"]." "."23:59:00";
                            $actividad->estado = 'Activo';
                            $actividad->id_prioridad = request('id_prioridad');
                            $actividad->update();
                            return response()->json('Actividad actualizada con exito', 200);
                        }else{
                            return response()->json('Actividad no encontrada',400);
                        }
                    }

                }else{
                    return response()->json("las fechas inicios o fechas  finales no pueden ser  iguales por registros diferentes",400);
                }

               }
               return response()->json("Error de servidor",500);
            }
            else if($validacion>0){
                return response()->json("las fechas inicio deben ser mayor o igual ala fecha actual y menor o igual a la fecha final",400);
            }



            }

    }
    public function updateActividadCondicionesLocativas(Request $request){

        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required|numeric',
            'id_plan_trabajo'=>'required|numeric',
            'id_actividad'=>'required|numeric',
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



        $respuesta=$this->validarQuenoExistanFechasRepetidadEnLaBase($fechas_base_datos,$fecha_ini,$fecha_finn);


        if($respuesta>0){

            return response()->json ("ya existen  estas  fechas registrada en esta actividad con este plan de trabajo en la base de dato",400);

        }else{

            $actividad = CondicionesLocativas::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
            if($actividad!= null){
                $actividad->fecha_inicio = request('fecha_inicio');
                $actividad->fecha_fin = request('fecha_fin').' '.'23:59:00';
                $actividad->estado = 'Activo';
                $actividad->id_prioridad = request('id_prioridad');
                $actividad->update();
                return response()->json('Actividad actualizada con exito', 200);
            }else{
                return response()->json('Actividad no encontrada',400);
            }
        }
                }
                else{
                    return response()->json("las fechas inicio deben ser mayor o igual ala fecha actual y menor o igual a la fecha final",400);

                }
        }



    }
    public function updateActividadKardex(Request $request){

        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required',
            'id_plan_trabajo'=>'required',
            'id_actividad'=>'required',
            'array_fechas.*.fecha_inicio'=>'date_format:"Y-m-d"|required|date',
            'array_fechas.*.fecha_fin'=>'date_format:"Y-m-d"|required|date'
        ]);
        if($validator->fails())
        {
          return response()->json( $errors=$validator->errors()->all() );
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
                            return response()->json('ya existen  estas  fechas registrada en esta actividad con este plan de trabajo en la base de dato',400);
                        }else{
                            $actividad = Kardex::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
                            if($actividad!= null){
                                $actividad->fecha_inicio = $fechas_converter_d[$i]["fecha_inicio"];
                                $actividad->fecha_fin = $fechas_converter_d[$i]["fecha_fin"]." "."23:59:00";
                                $actividad->estado = 'Activo';
                                $actividad->id_prioridad = request('id_prioridad');
                                $actividad->update();
                                return response()->json('Actividad actualizada con exito', 200);
                            }else{
                                return response()->json('Actividad no encontrada',400);
                            }

                        }
                    }else{
                        return response()->json("las fechas inicios o fechas  finales no pueden ser  iguales",400);
                    }
                 }
              }
              elseif($validacion>0)
              {
                return response()->json("la fecha de inicio debe ser igual o mayor a la fecha actual y menor o igual a la fecha final",400);
              }
            }
    }
    public function updateActividadSeguimientoVendedor(Request $request){



        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required',
            'id_plan_trabajo'=>'required',
            'id_actividad'=>'required',
            'array_fechas.*.fecha_inicio'=>'date_format:"Y-m-d"|required|date',
            'array_fechas.*.fecha_fin'=>'date_format:"Y-m-d"|required|date'
        ]);
        if($validator->fails())
        {
          return response()->json( $errors=$validator->errors()->all() );
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
                            return response()->json('ya existen  estas  fechas registrada en esta actividad con este plan de trabajo en la base de dato',400);
                        }else{
                            $actividad = SeguimientoVendedor::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
                            if($actividad!= null){
                                $actividad->fecha_inicio = $fechas_converter_d[$i]["fecha_inicio"];
                                $actividad->fecha_fin = $fechas_converter_d[$i]["fecha_fin"]." "."23:59:00";
                                $actividad->estado = 'Activo';
                                $actividad->id_prioridad = request('id_prioridad');
                                $actividad->update();
                                return response()->json('Actividad actualizada con exito', 200);
                            }else{
                                return response()->json('Actividad no encontrada',400);
                            }

                        }

                    }else{
                        return response()->json("las fechas inicios o fechas  finales no pueden ser  iguales por registros diferentes",400);
                    }

                }
              }
              elseif($validacion>0)
              {
                return response()->json("fechas inicio deben ser mayores o iguales a la fecha actual y la fecha fin debe ser mayor o igual ala inicial",400);
              }
            }


    }
    public function updateActividadEvaluacionPedidos(Request $request){


        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required|numeric',
            'id_plan_trabajo'=>'required|numeric',
            'id_actividad'=>'required|numeric',
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

                $fechas_base_datos=DB::table('evaluacion_pedidos')
            ->select('fecha_inicio','id_plan_trabajo','fecha_fin')
            ->where('id_plan_trabajo',request('id_plan_trabajo'))
            ->get();

        $fecha_ini=request('fecha_inicio');
        $fecha_finn=request('fecha_fin');

        $respuesta=$this->validarQuenoExistanFechasRepetidadEnLaBase($fechas_base_datos,$fecha_ini,$fecha_finn);


        if($respuesta>0){

            return response()->json ("ya existen  estas  fechas registrada en esta actividad con este plan de trabajo en la base de dato",400);

        }else{
            $actividad = EvaluacionPedidos::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
                            if($actividad!= null){
                                $actividad->fecha_inicio = request('fecha_inicio');
                                $actividad->fecha_fin = request('fecha_fin').' '.'23:59:00';
                                $actividad->estado = 'Activo';
                                $actividad->id_prioridad = request('id_prioridad');
                                $actividad->update();
                                return response()->json('Actividad actualizada con exito', 200);
                            }else{
                                return response()->json('Actividad no encontrada',400);
                            }
        }


            }else{
                return response()->json("las fechas inicio deben ser mayor o igual ala fecha actual y menor o igual a la fecha final",400);

            }



        }

    }
    public function updateActividadPresupuestoPedidos(Request $request){

        //imporante el id del plana detrabajo debe estar creado a la hora de crear las actividades a dicho plan de trabajo

        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required|numeric',
            'id_plan_trabajo'=>'required|numeric',
            'id_actividad'=>'required|numeric',
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


                $fechas_base_datos=DB::table('presupuesto_pedido')
                ->select('fecha_inicio','id_plan_trabajo','fecha_fin')
                ->where('id_plan_trabajo',request('id_plan_trabajo'))
                ->get();

            $fecha_ini=request('fecha_inicio');
            $fecha_finn=request('fecha_fin');

            $respuesta=$this->validarQuenoExistanFechasRepetidadEnLaBase($fechas_base_datos,$fecha_ini,$fecha_finn);

                    if($respuesta>0){

                    return response()->json ("ya existen  estas  fechas registrada en esta actividad con este plan de trabajo en la base de dato",400);

                }else{
                    $actividad = PresupuestoPedidos::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
                    if($actividad!= null){
                        $actividad->fecha_inicio = request('fecha_inicio');
                        $actividad->fecha_fin = request('fecha_fin').' '.'23:59:00';
                        $actividad->estado = 'Activo';
                        $actividad->id_prioridad = request('id_prioridad');
                        $actividad->update();
                        return response()->json('Actividad actualizada con exito', 200);
                    }else{
                        return response()->json('Actividad no encontrada',400);
                    }

                }
            }else{
                return response()->json("las fechas inicio deben ser mayor o igual ala fecha actual y menor o igual a la fecha final",400);

            }



        }

    }
    public function updateActividadLibrosFaltantes(Request $request){

        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required',
            'id_plan_trabajo'=>'required',
            'id_actividad'=>'required',
            'array_fechas.*.fecha_inicio'=>'date_format:"Y-m-d"|required|date',
            'array_fechas.*.fecha_fin'=>'date_format:"Y-m-d"|required|date'
        ]);
        if($validator->fails())
        {
          return response()->json( $errors=$validator->errors()->all() );
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
                            return response()->json('ya existen  estas  fechas registrada en esta actividad con este plan de trabajo en la base de dato',400);
                        }else{


                            $actividad = LibrosFaltantes::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
                            if($actividad!= null){
                                $actividad->fecha_inicio = $fechas_converter_d[$i]["fecha_inicio"];
                                $actividad->fecha_fin = $fechas_converter_d[$i]["fecha_fin"]." "."23:59:00";
                                $actividad->estado = 'Activo';
                                $actividad->id_prioridad = request('id_prioridad');
                                $actividad->update();
                                return response()->json('Actividad actualizada con exito', 200);
                            }else{
                                return response()->json('Actividad no encontrada',400);
                            }

                        }
                    }else{
                        return response()->json("las fechas inicios o fechas  finales no pueden ser  iguales por registros diferentes",400);
                    }
                 }
              }
              elseif($validacion>0)
              {
                return response()->json("la fecha de inicio debe ser igual o mayor a la fecha actual y menor o igual a la fecha final",400);
              }
            }
    }
    public function updateActividadCapturaClientes(Request $request){


        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required|numeric',
            'id_actividad' => 'required|numeric',
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

                $fechas_base_datos=DB::table('captura_cliente')
            ->select('fecha_inicio','id_plan_trabajo','fecha_fin')
            ->where('id_plan_trabajo',request('id_plan_trabajo'))
            ->get();

        $fecha_ini=request('fecha_inicio');
        $fecha_finn=request('fecha_fin');

        $respuesta=$this->validarQuenoExistanFechasRepetidadEnLaBase($fechas_base_datos,$fecha_ini,$fecha_finn);


        if($respuesta>0){

            return response()->json ("ya existen  estas  fechas registrada en esta actividad con este plan de trabajo en la base de dato",400);

        }else{
            $actividad = CapturaClientes::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
            if($actividad!= null){
                $actividad->fecha_inicio = request('fecha_inicio');
                $actividad->fecha_fin = request('fecha_fin').' '.'23:59:00';
                $actividad->estado = 'Activo';
                $actividad->id_prioridad = request('id_prioridad');
                $actividad->update();
                return response()->json('Actividad actualizada con exito', 200);
            }else{
                return response()->json('Actividad no encontrada',400);
            }
               
        }


                return response()->json("Actividad  Captura Cliente  creada",201);

            }else{
                return response()->json("la fecha de inicio debe ser igual o mayor a la fecha actual y menor o igual a la fecha final",400);

            }



        }


    }
    public function updateActividadLibroAgendaCliente(Request $request){

        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required',
            'id_plan_trabajo'=>'required',
            'id_actividad'=>'required',
            'array_fechas.*.fecha_inicio'=>'date_format:"Y-m-d"|required|date',
            'array_fechas.*.fecha_fin'=>'date_format:"Y-m-d"|required|date'
        ]);
        if($validator->fails())
        {
          return response()->json( $errors=$validator->errors()->all() );
        }

        else
        {


            $fechas=request('array_fechas');
            //codificacion a json
            $fechas_converter=json_encode($fechas,true);
            //decodificcion del reques recibido para iterar el aary
            $fechas_converter_d=json_decode($fechas_converter,true);


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
                            return response()->json('ya existen  estas  fechas registrada en esta actividad con este plan de trabajo en la base de dato',400);
                        }else{
                            $actividad = LibroAgendasCliente::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
                            if($actividad!= null){
                                $actividad->fecha_inicio = $fechas_converter_d[$i]["fecha_inicio"];
                                $actividad->fecha_fin = $fechas_converter_d[$i]["fecha_fin"]." "."23:59:00";
                                $actividad->estado = 'Activo';
                                $actividad->id_prioridad = request('id_prioridad');
                                $actividad->update();
                                return response()->json('Actividad actualizada con exito', 200);
                            }else{
                                return response()->json('Actividad no encontrada',400);
                            }
                        }

                    }else{
                        return response()->json("las fechas inicios o fechas  finales no pueden ser  iguales por registros diferentes",400);
                    }
                 }
                return response()->json("Actividad libro agenda cliente creada",201);
              }
              elseif($validacion>0)
              {
                return response()->json("la fecha de inicio debe ser igual o mayor a la fecha actual y menor o igual a la fecha final",400);
              }
            }
    }
    public function updateActividadConvenioExhibicion(Request $request){

        //imporante el id del plana detrabajo debe estar creado a la hora de crear las actividades a dicho plan de trabajo

        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required|numeric',
            'id_plan_trabajo'=>'required|numeric',
            'id_actividad'=>'required|numeric',
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

            return response()->json ("ya existen  estas  fechas registrada en esta actividad con este plan de trabajo en la base de dato",400);

        }else{
            $actividad = CapturaClientes::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
            if($actividad!= null){
                $actividad->fecha_inicio = request('fecha_inicio');
                $actividad->fecha_fin = request('fecha_fin').' '.'23:59:00';
                $actividad->estado = 'Activo';
                $actividad->id_prioridad = request('id_prioridad');
                $actividad->update();
                return response()->json('Actividad actualizada con exito', 200);
            }else{
                return response()->json('Actividad no encontrada',400);
            }
        }

            }else{
                return response()->json("las fechas inicio deben ser mayor o igual ala fecha actual y menor o igual a la fecha final",400);

            }



        }

    }
    public function updateActividadExcesos(Request $request){

        //imporante el id del plana detrabajo debe estar creado a la hora de crear las actividades a dicho plan de trabajo

        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required|numeric',
            'id_plan_trabajo'=>'required|numeric',
            'id_actividad'=>'required|numeric',
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

            return response()->json ("ya existen  estas  fechas registrada en esta actividad con este plan de trabajo en la base de dato",400);

        }else{
            $actividad = Excesos::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
            if($actividad!= null){
                $actividad->fecha_inicio = request('fecha_inicio');
                $actividad->fecha_fin = request('fecha_fin').' '.'23:59:00';
                $actividad->estado = 'Activo';
                $actividad->id_prioridad = request('id_prioridad');
                $actividad->update();
                return response()->json('Actividad actualizada con exito', 200);
            }else{
                return response()->json('Actividad no encontrada',400);
            }
        }

                // DB::commit();

                return response()->json("Actividad Excesos creada",201);

            }else{
                return response()->json("fechas incorrectas la fecha inicio debe ser mayor o igual ala actual y menor o igua a la final",400);

            }



        }

    }
    public function updateActividadLibroVencimientos(Request $request){

        //imporante el id del plana detrabajo debe estar creado a la hora de crear las actividades a dicho plan de trabajo

        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required|numeric',
            'id_plan_trabajo'=>'required|numeric',
            'id_actividad'=>'required|numeric',
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

            return response()->json ("ya existen  estas  fechas registrada en esta actividad con este plan de trabajo en la base de dato",400);

        }else{
            $actividad = LibroVencimientos::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
            if($actividad!= null){
                $actividad->fecha_inicio = request('fecha_inicio');
                $actividad->fecha_fin = request('fecha_fin').' '.'23:59:00';
                $actividad->estado = 'Activo';
                $actividad->id_prioridad = request('id_prioridad');
                $actividad->update();
                return response()->json('Actividad actualizada con exito', 200);
            }else{
                return response()->json('Actividad no encontrada',400);
            }

        }

                // DB::commit();

                return response()->json("Actividad Libro Vencimientos  creada",201);

            }else{
                return response()->json("fechas incorrectas la fecha inicio debe ser mayor o igual ala actual y menor o igua a la final",400);

            }



        }

    }
    public function updateActividadIngresoSucursal(Request $request){

        //imporante el id del plana detrabajo debe estar creado a la hora de crear las actividades a dicho plan de trabajo

        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required|numeric',
            'id_plan_trabajo'=>'required|numeric',
            'id_actividad'=>'required|numeric',
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

            return response()->json ("ya existen  estas  fechas registrada en esta actividad con este plan de trabajo en la base de dato",400);

        }else{
            $actividad = IngresoSucursal::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
            if($actividad!= null){
                $actividad->fecha_inicio = request('fecha_inicio');
                $actividad->fecha_fin = request('fecha_fin').' '.'23:59:00';
                $actividad->estado = 'Activo';
                $actividad->id_prioridad = request('id_prioridad');
                $actividad->update();
                return response()->json('Actividad actualizada con exito', 200);
            }else{
                return response()->json('Actividad no encontrada',400);
            }
        
        }

            }else{
                return response()->json("fechas incorrectas la fecha inicio debe ser mayor o igual ala actual y menor o igua a la final",400);

            }



        }

    }
}
