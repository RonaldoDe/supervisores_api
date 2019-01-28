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
                    'estado' =>'Activo',

                ]);
        }

                // DB::commit();
                }
                else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }


    }

    public function documentacion_legal(Request $request){

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
                        return response()->json(["success"=>"Actividad no encontrada o error al crearla."],400);
    
                    }
    
                }
    
    
    
            }else{
                return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);
    
            }
    
    
    
        }
    
    }

    public function papeleria_consignaciones(Request $request){

        $validator=\Validator::make($request->all(),[

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


        //instancia del modelo documentacion legal para crear un registro de esta tabla
                $papeleria =PapeleriaConsignaciones::create([
                    'id_plan_trabajo' =>request('id_plan_trabajo'),
                    'fecha_inicio' =>request('fecha_inicio'),
                    'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                    'observacion'=>'',
                    'id_prioridad' =>1,
                    'estado' =>'Activo',

                ]);
                
        }
                // DB::commit();

                }
                else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }



            }

    }

    public function formulas_despachos(Request $request){

        $validator=\Validator::make($request->all(),[
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


        //instancia del modelo documentacion legal para crear un registro de esta tabla
                $formulas =FormulasDespachos::create([
                    'id_plan_trabajo' =>request('id_plan_trabajo'),
                    'fecha_inicio' =>request('fecha_inicio'),
                    'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                    'observacion'=>'',
                    'id_prioridad' =>1,
                    'estado' =>'Activo',

                ]);
                
        }
                // DB::commit();

                }
                else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }


            }


    }

    public function remisiones(Request $request){



        $validator=\Validator::make($request->all(),[
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


        //instancia del modelo documentacion legal para crear un registro de esta tabla
                $remisiones =Remisiones::create([
                    'id_plan_trabajo' =>request('id_plan_trabajo'),
                    'fecha_inicio' =>request('fecha_inicio'),
                    'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                    'observacion'=>'',
                    'id_prioridad' =>1,
                    'estado' =>'Activo',

                ]);
        }
                // DB::commit();
                

                }
                else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }

            }

    }

    public function condiciones_locativas(Request $request){


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
                    'id_prioridad' =>1,
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
                    return response()->json(["success"=>"Actividad no encontrada o error al crearla."],400);

                }
        }
                // DB::commit();
                }
                else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
        }



    }

    public function kardex(Request $request){
        
        $validator=\Validator::make($request->all(),[
            'id_plan_trabajo'=>'required',
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


        //instancia del modelo documentacion legal para crear un registro de esta tabla
                $kardex =Kardex::create([
                    'id_plan_trabajo' =>request('id_plan_trabajo'),
                    'fecha_inicio' =>request('fecha_inicio'),
                    'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                    'observacion'=>'',
                    'id_prioridad' =>1,
                    'estado' =>'Activo',

                ]);
                
        }
                // DB::commit();

                }
                else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }

    public function seguimiento_vendedores(Request $request){



        $validator=\Validator::make($request->all(),[
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


        //instancia del modelo documentacion legal para crear un registro de esta tabla
                $seguimiento =SeguimientoVendedor::create([
                    'id_plan_trabajo' =>request('id_plan_trabajo'),
                    'fecha_inicio' =>request('fecha_inicio'),
                    'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                    'observacion'=>'',
                    'id_prioridad' =>1,
                    'estado' =>'Activo',

                ]);

                
        }
                // DB::commit();

                }
                else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }


    }

    public function evaluacion_pedidos(Request $request){

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
                    'id_prioridad' =>1,
                    'estado' =>'Activo',

                ]);

                
                
        }


            }else{
                return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

            }



        }

    }

    public function presupuesto_pedido(Request $request){

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
                    $presupuestoPedidos =PresupuestoPedidos::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>1,
                        'estado' =>'Activo',
                    ]);
                    
                }
                

            }else{
                return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

            }
        }
    }

    public function libros_faltantes(Request $request){

        $validator=\Validator::make($request->all(),[
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


        //instancia del modelo documentacion legal para crear un registro de esta tabla
                $libroFaltante =LibrosFaltantes::create([
                    'id_plan_trabajo' =>request('id_plan_trabajo'),
                    'fecha_inicio' =>request('fecha_inicio'),
                    'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                    'observacion'=>'',
                    'id_prioridad' =>1,
                    'estado' =>'Activo',

                ]);
                
        }
                // DB::commit();

                }
                else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }

    public function captura_cliente(Request $request){

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
                        'id_prioridad' =>1,
                        'estado' =>'Activo',

                    ]);
                    
            }
                    // DB::commit();

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }

    public function libro_agendaclientes(Request $request){

        $validator=\Validator::make($request->all(),[
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

                $fechas_base_datos=DB::table('libro_agendaclientes')
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
                $libroAgenda =LibroAgendasCliente::create([
                    'id_plan_trabajo' =>request('id_plan_trabajo'),
                    'fecha_inicio' =>request('fecha_inicio'),
                    'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                    'observacion'=>'',
                    'id_prioridad' =>1,
                    'estado' =>'Activo',

                ]);

                
        }
                // DB::commit();

                }
                else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }

    public function convenio_exhibicion(Request $request){

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
                    'id_prioridad' =>1,
                    'estado' =>'Activo',

                ]);
                
        }

                // DB::commit();


            }else{
                return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

            }



        }

    }

    public function excesos(Request $request){

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
                    'id_prioridad' =>1,
                    'estado' =>'Activo',

                ]);
        }

                // DB::commit();

                

            }else{
                return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

            }



        }

    }

    public function libro_vencimientos(Request $request){

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
                    'id_prioridad' =>1,
                    'estado' =>'Activo',

                ]);
        }

                // DB::commit();

                

            }else{
                return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

            }



        }

    }

    public function ingreso_sucursal(Request $request){

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
                    'id_prioridad' =>1,
                    'estado' =>'Activo',

                ]);
        }
                // DB::commit();

                

            }else{
                return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

            }
        }

    }

}
