<?php

namespace App\Http\Controllers\Api\Auth\Coordinador\Actividades;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Modelos\Actividades\Apertura;
use App\Modelos\Actividades\DocumentacionLegal;
use App\Modelos\Actividades\Remisiones;
use App\Modelos\Actividades\CondicionesLocativas;
use App\Modelos\Actividades\Kardex;
use App\Modelos\Actividades\LibrosFaltantes;
use App\Modelos\Actividades\LibroVencimientos;
use App\Modelos\Actividades\ActividadPtc;
use App\Modelos\Actividades\ArqueoCaja;
use App\Modelos\Actividades\Domicilio;
use App\Modelos\Actividades\EnvioCorrespondencia;
use App\Modelos\Actividades\ExamenGimed;
use App\Modelos\Actividades\EvolucionClientes;
use App\Modelos\Actividades\Exhibiciones;
use App\Modelos\Actividades\Facturacion;
use App\Modelos\Actividades\Gimed;
use App\Modelos\Actividades\InventarioMercancia;
use App\Modelos\Actividades\Julienne;
use App\Modelos\Actividades\ProductosBonificados;
use App\Modelos\Actividades\ProgramaMercadeo;
use App\Modelos\Actividades\RelacionServiciosPublicos;
use App\Modelos\Actividades\RelacionVendedores;
use App\Modelos\Actividades\ServicioBodega;
use App\Modelos\Actividades\UsoInstitucional;

class UpdateActividadesController extends Controller
{
  
    //##############################################################
    public function update_apertura(Request $request)
    {

        $validator=\Validator::make($request->all(),[
            // 'id_prioridad' => 'required|numeric',
            'id_actividad'=>'required',
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
                ->where('id', '!=', request('id_actividad'))
                ->get();

            $fecha_ini=request('fecha_inicio');
            $fecha_finn=request('fecha_fin');


        //funcion que valida las fechas a insertar en la base de dato hay que colocar esta funcion en las actividades qe
        //no son tan frecuentes y hay que hacer la funcion para os planes de trabajos que son frecuentes
        $respuesta=$this->validarQuenoExistanFechasRepetidadEnLaBase($fechas_base_datos,$fecha_ini,$fecha_finn);


        if($respuesta>0){

            return response()->json (["Ya existen estas fechas registradas en esta actividad con este plan de trabajo en la base de datos."],400);

        }else{


            $actividad = Apertura::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
            if($actividad!= null){
                $actividad->fecha_inicio = request('fecha_inicio');
                $actividad->fecha_fin = request('fecha_fin').' '.'23:59:00';
                $actividad->id_estado = 1;
                $actividad->update();
                return response()->json('Actividad actualizada con exito',200);
            }
            return response()->json(['Actividad no encontrada'],400);
        }

                // DB::commit();
                }
                else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }


    }
    public function update_documentacion_legal(Request $request){

        //imporante el id del plana detrabajo debe estar creado a la hora de crear las actividades a dicho plan de trabajo
    
        $validator=\Validator::make($request->all(),[
            'id_plan_trabajo'=>'required|numeric',
            'id_prioridad' => 'required|numeric',
            'fecha_inicio'=>'date_format:"Y-m-d"|required',
            'id_actividad'=>'required',
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
                ->where('id', '!=', request('id_actividad'))
                ->get();
    
                $fecha_ini=request('fecha_inicio');
                $fecha_finn=request('fecha_fin');
    
    
    
                $respuesta=$this->validarQuenoExistanFechasRepetidadEnLaBase($fechas_base_datos,$fecha_ini,$fecha_finn);
    
                if($respuesta>0){
    
                    return response()->json (["Ya existen estas fechas registradas en esta actividad con este plan de trabajo en la base de datos."],400);
                }else{
    
                    $actividad = DocumentacionLegal::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
                        if($actividad!= null){
                            $actividad->fecha_inicio = request('fecha_inicio');
                            $actividad->fecha_fin = request('fecha_fin').' '.'23:59:00';
                            $actividad->id_estado = 1;
                            $actividad->id_prioridad = request('id_prioridad');
                            $actividad->update();
                            return response()->json('Actividad actualizada con exito',200);
                        }
                        return response()->json(['Actividad no encontrada'],400);
    
                }
    
    
    
            }else{
                return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);
    
            }
    
    
    
        }
    
    }
    public function update_arqueo_caja(Request $request){

        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required|numeric',
            'id_plan_trabajo'=>'required|numeric',
            'fecha_inicio'=>'date_format:"Y-m-d"|required|date',
            'id_actividad'=>'required',
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
                ->where('id', '!=', request('id_actividad'))
                ->get();

            $fecha_ini=request('fecha_inicio');
            $fecha_finn=request('fecha_fin');
            //funcion que valida las fechas a insertar en la base de dato hay que colocar esta funcion en las actividades qe
            //no son tan frecuentes y hay que hacer la funcion para os planes de trabajos que son frecuentes
            $respuesta=$this->validarQuenoExistanFechasRepetidadEnLaBase($fechas_base_datos,$fecha_ini,$fecha_finn);


            if($respuesta>0){

                return response()->json (["Ya existen estas fechas registradas en esta actividad con este plan de trabajo en la base de datos."],400);

            }else{
                $actividad = ArqueoCaja::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
                if($actividad!= null){
                    $actividad->fecha_inicio = request('fecha_inicio');
                    $actividad->fecha_fin = request('fecha_fin').' '.'23:59:00';
                    $actividad->id_estado = 1;
                    $actividad->id_prioridad = request('id_prioridad');
                    $actividad->update();
                    return response()->json('Actividad actualizada con exito',200);
                }
                return response()->json(['Actividad no encontrada'],400);
            }

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }



            }
    }
    public function update_condiciones_locativas(Request $request){


        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required|numeric',
            'id_plan_trabajo'=>'required|numeric',
            'fecha_inicio'=>'date_format:"Y-m-d"|required',
            'id_actividad'=>'required',
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
                ->where('id', '!=', request('id_actividad'))
                ->get();

            $fecha_ini=request('fecha_inicio');
            $fecha_finn=request('fecha_fin');


        //funcion que valida las fechas a insertar en la base de dato hay que colocar esta funcion en las actividades qe
        //no son tan frecuentes y hay que hacer la funcion para os planes de trabajos que son frecuentes
        $respuesta=$this->validarQuenoExistanFechasRepetidadEnLaBase($fechas_base_datos,$fecha_ini,$fecha_finn);


        if($respuesta>0){

            return response()->json (["Ya existen estas fechas registradas en esta actividad con este plan de trabajo en la base de datos."],400);

        }else{


        $actividad = CondicionesLocativas::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
        if($actividad!= null){
            $actividad->fecha_inicio = request('fecha_inicio');
            $actividad->fecha_fin = request('fecha_fin').' '.'23:59:00';
            $actividad->id_estado = 1;
            $actividad->id_prioridad = request('id_prioridad');
            $actividad->update();
            return response()->json('Actividad actualizada con exito',200);
        }
        return response()->json(['Actividad no encontrada'],400);
        }

                }
                else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
        }



    }
    public function update_domicilios(Request $request){

        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required|numeric',
            'id_plan_trabajo'=>'required|numeric',
            'fecha_inicio'=>'date_format:"Y-m-d"|required|date',
            'fecha_fin'=>'date_format:"Y-m-d"|required|date',
            'id_actividad' => 'required',

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
                ->where('id', '!=', request('id_actividad'))
                ->get();

            $fecha_ini=request('fecha_inicio');
            $fecha_finn=request('fecha_fin');
            //funcion que valida las fechas a insertar en la base de dato hay que colocar esta funcion en las actividades qe
             //no son tan frecuentes y hay que hacer la funcion para os planes de trabajos que son frecuentes
            $respuesta=$this->validarQuenoExistanFechasRepetidadEnLaBase($fechas_base_datos,$fecha_ini,$fecha_finn);

            if($respuesta>0){

                return response()->json (["Ya existen estas fechas registradas en esta actividad con este plan de trabajo en la base de datos."],400);

            }else{
                $actividad = Domicilio::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
                if($actividad!= null){
                    $actividad->fecha_inicio = request('fecha_inicio');
                    $actividad->fecha_fin = request('fecha_fin').' '.'23:59:00';
                    $actividad->id_estado = 1;
                    $actividad->id_prioridad = request('id_prioridad');
                    $actividad->update();
                    return response()->json('Actividad actualizada con exito',200);
                }
                return response()->json(['Actividad no encontrada'],400);
            }
                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }

            }
    }
    public function update_envio_correspondencia(Request $request)
         {

            $validator=\Validator::make($request->all(),[
                'id_prioridad' => 'required|numeric',
                'id_plan_trabajo'=>'required|numeric',
                'fecha_inicio'=>'date_format:"Y-m-d"|required',
                'fecha_fin'=>'date_format:"Y-m-d"|required',
                'id_actividad' => 'required',
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
                ->where('id', '!=', request('id_actividad'))
                ->get();

            $fecha_ini=request('fecha_inicio');
            $fecha_finn=request('fecha_fin');
            //funcion que valida las fechas a insertar en la base de dato hay que colocar esta funcion en las actividades qe
            //no son tan frecuentes y hay que hacer la funcion para os planes de trabajos que son frecuentes
            $respuesta=$this->validarQuenoExistanFechasRepetidadEnLaBase($fechas_base_datos,$fecha_ini,$fecha_finn);

            if($respuesta>0){

                return response()->json (["Ya existen estas fechas registradas en esta actividad con este plan de trabajo en la base de datos."],400);

            }else{
                $actividad = EnvioCorrespondencia::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
                if($actividad!= null){
                    $actividad->fecha_inicio = request('fecha_inicio');
                    $actividad->fecha_fin = request('fecha_fin').' '.'23:59:00';
                    $actividad->id_estado = 1;
                    $actividad->id_prioridad = request('id_prioridad');
                    $actividad->update();
                    return response()->json('Actividad actualizada con exito',200);
                }
                return response()->json(['Actividad no encontrada'],400);
            }

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }


            }

    }
    public function update_evolucion_clientes(Request $request){

        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required|numeric',
            'id_plan_trabajo'=>'required|numeric',
            'fecha_inicio'=>'date_format:"Y-m-d"|required|date',
            'fecha_fin'=>'date_format:"Y-m-d"|required|date',
            'id_actividad' => 'required',

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
                ->where('id', '!=', request('id_actividad'))
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
                $actividad = EvolucionClientes::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
                if($actividad!= null){
                    $actividad->fecha_inicio = request('fecha_inicio');
                    $actividad->fecha_fin = request('fecha_fin').' '.'23:59:00';
                    $actividad->id_estado = 1;
                    $actividad->id_prioridad = request('id_prioridad');
                    $actividad->update();
                    return response()->json('Actividad actualizada con exito',200);
                }
                return response()->json(['Actividad no encontrada'],400);
            }

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }



            }
    }
    public function update_examen_gimed(Request $request){

        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required|numeric',
            'id_plan_trabajo'=>'required|numeric',
            'fecha_inicio'=>'date_format:"Y-m-d"|required|date',
            'fecha_fin'=>'date_format:"Y-m-d"|required|date',
            'id_actividad' => 'required',

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
                ->where('id', '!=', request('id_actividad'))
                ->get();

            $fecha_ini=request('fecha_inicio');
            $fecha_finn=request('fecha_fin');
            //funcion que valida las fechas a insertar en la base de dato hay que colocar esta funcion en las actividades qe
            //no son tan frecuentes y hay que hacer la funcion para os planes de trabajos que son frecuentes
            $respuesta=$this->validarQuenoExistanFechasRepetidadEnLaBase($fechas_base_datos,$fecha_ini,$fecha_finn);


            if($respuesta>0){

                return response()->json (["Ya existen estas fechas registradas en esta actividad con este plan de trabajo en la base de datos."],400);

            }else{
                $actividad = ExamenGimed::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
                if($actividad!= null){
                    $actividad->fecha_inicio = request('fecha_inicio');
                    $actividad->fecha_fin = request('fecha_fin').' '.'23:59:00';
                    $actividad->id_estado = 1;
                    $actividad->id_prioridad = request('id_prioridad');
                    $actividad->update();
                    return response()->json('Actividad actualizada con exito',200);
                }
                return response()->json(['Actividad no encontrada'],400);
            }

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }



            }
    }
    public function update_exhibiciones(Request $request){

        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required|numeric',
            'id_plan_trabajo'=>'required|numeric',
            'fecha_inicio'=>'date_format:"Y-m-d"|required|date',
            'fecha_fin'=>'date_format:"Y-m-d"|required|date',
            'id_actividad' => 'required',

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
                ->where('id', '!=', request('id_actividad'))
                ->get();

            $fecha_ini=request('fecha_inicio');
            $fecha_finn=request('fecha_fin');
            //funcion que valida las fechas a insertar en la base de dato hay que colocar esta funcion en las actividades qe
            //no son tan frecuentes y hay que hacer la funcion para os planes de trabajos que son frecuentes
            $respuesta=$this->validarQuenoExistanFechasRepetidadEnLaBase($fechas_base_datos,$fecha_ini,$fecha_finn);

            if($respuesta>0){

                return response()->json (["Ya existen estas fechas registradas en esta actividad con este plan de trabajo en la base de datos."],400);

            }else{
                $actividad = Exhibiciones::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
                if($actividad!= null){
                    $actividad->fecha_inicio = request('fecha_inicio');
                    $actividad->fecha_fin = request('fecha_fin').' '.'23:59:00';
                    $actividad->id_estado = 1;
                    $actividad->id_prioridad = request('id_prioridad');
                    $actividad->update();
                    return response()->json('Actividad actualizada con exito',200);
                }
                return response()->json(['Actividad no encontrada'],400);
            }

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }

            }
    }
    public function update_facturacion(Request $request){

        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required|numeric',
            'id_plan_trabajo'=>'required|numeric',
            'fecha_inicio'=>'date_format:"Y-m-d"|required|date',
            'fecha_fin'=>'date_format:"Y-m-d"|required|date',
            'id_actividad' => 'required',
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
                ->where('id', '!=', request('id_actividad'))
                ->get();

            $fecha_ini=request('fecha_inicio');
            $fecha_finn=request('fecha_fin');
            //funcion que valida las fechas a insertar en la base de dato hay que colocar esta funcion en las actividades qe
            //no son tan frecuentes y hay que hacer la funcion para os planes de trabajos que son frecuentes
            $respuesta=$this->validarQuenoExistanFechasRepetidadEnLaBase($fechas_base_datos,$fecha_ini,$fecha_finn);

            if($respuesta>0){

                return response()->json (["Ya existen estas fechas registradas en esta actividad con este plan de trabajo en la base de datos."],400);

            }else{
                $actividad = Facturacion::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
                if($actividad!= null){
                    $actividad->fecha_inicio = request('fecha_inicio');
                    $actividad->fecha_fin = request('fecha_fin').' '.'23:59:00';
                    $actividad->id_estado = 1;
                    $actividad->id_prioridad = request('id_prioridad');
                    $actividad->update();
                    return response()->json('Actividad actualizada con exito',200);
                }
                return response()->json(['Actividad no encontrada'],400);
            }

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }
    public function update_gimed(Request $request){

        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required|numeric',
            'id_plan_trabajo'=>'required|numeric',
            'fecha_inicio'=>'date_format:"Y-m-d"|required|date',
            'fecha_fin'=>'date_format:"Y-m-d"|required|date',
            'id_actividad' => 'required',
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
                ->where('id', '!=', request('id_actividad'))
                ->get();

            $fecha_ini=request('fecha_inicio');
            $fecha_finn=request('fecha_fin');
            //funcion que valida las fechas a insertar en la base de dato hay que colocar esta funcion en las actividades qe
            //no son tan frecuentes y hay que hacer la funcion para os planes de trabajos que son frecuentes
            $respuesta=$this->validarQuenoExistanFechasRepetidadEnLaBase($fechas_base_datos,$fecha_ini,$fecha_finn);

            if($respuesta>0){

                return response()->json (["Ya existen estas fechas registradas en esta actividad con este plan de trabajo en la base de datos."],400);

            }else{
                $actividad = Gimed::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
                if($actividad!= null){
                    $actividad->fecha_inicio = request('fecha_inicio');
                    $actividad->fecha_fin = request('fecha_fin').' '.'23:59:00';
                    $actividad->id_estado = 1;
                    $actividad->id_prioridad = request('id_prioridad');
                    $actividad->update();
                    return response()->json('Actividad actualizada con exito',200);
                }
                return response()->json(['Actividad no encontrada'],400);
            }

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }
    public function update_kardex(Request $request){

        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required|numeric',
            'id_plan_trabajo'=>'required|numeric',
            'fecha_inicio'=>'date_format:"Y-m-d"|required|date',
            'fecha_fin'=>'date_format:"Y-m-d"|required|date',
            'id_actividad' => 'required',
            'laboratorios' => 'required',
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
                ->where('id', '!=', request('id_actividad'))
                ->get();

            $fecha_ini=request('fecha_inicio');
            $fecha_finn=request('fecha_fin');
            //funcion que valida las fechas a insertar en la base de dato hay que colocar esta funcion en las actividades qe
            //no son tan frecuentes y hay que hacer la funcion para os planes de trabajos que son frecuentes
            $respuesta=$this->validarQuenoExistanFechasRepetidadEnLaBase($fechas_base_datos,$fecha_ini,$fecha_finn);

            if($respuesta>0){

                return response()->json (["Ya existen estas fechas registradas en esta actividad con este plan de trabajo en la base de datos."],400);

            }else{
                $actividad = Kardex::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
                if($actividad!= null){
                    $actividad->fecha_inicio = request('fecha_inicio');
                    $actividad->fecha_fin = request('fecha_fin').' '.'23:59:00';
                    $actividad->id_estado = 1;
                    $actividad->id_prioridad = request('id_prioridad');
                    $actividad->laboratorios_asignados = request('laboratorios');
                    $actividad->update();
                    return response()->json('Actividad actualizada con exito',200);
                }
                return response()->json(['Actividad no encontrada'],400);
            }

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }
    public function update_inventario_mercancia(Request $request){

        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required|numeric',
            'id_plan_trabajo'=>'required|numeric',
            'fecha_inicio'=>'date_format:"Y-m-d"|required|date',
            'fecha_fin'=>'date_format:"Y-m-d"|required|date',
            'id_actividad' => 'required',
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
                ->where('id', '!=', request('id_actividad'))
                ->get();

            $fecha_ini=request('fecha_inicio');
            $fecha_finn=request('fecha_fin');
            //funcion que valida las fechas a insertar en la base de dato hay que colocar esta funcion en las actividades qe
            //no son tan frecuentes y hay que hacer la funcion para os planes de trabajos que son frecuentes
            $respuesta=$this->validarQuenoExistanFechasRepetidadEnLaBase($fechas_base_datos,$fecha_ini,$fecha_finn);

            if($respuesta>0){

                return response()->json (["Ya existen estas fechas registradas en esta actividad con este plan de trabajo en la base de datos."],400);

            }else{
                $actividad = InventarioMercancia::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
                if($actividad!= null){
                    $actividad->fecha_inicio = request('fecha_inicio');
                    $actividad->fecha_fin = request('fecha_fin').' '.'23:59:00';
                    $actividad->id_estado = 1;
                    $actividad->id_prioridad = request('id_prioridad');
                    $actividad->update();
                    return response()->json('Actividad actualizada con exito',200);
                }
                return response()->json(['Actividad no encontrada'],400);
            }

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }
    public function update_julienne(Request $request){

        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required|numeric',
            'id_plan_trabajo'=>'required|numeric',
            'fecha_inicio'=>'date_format:"Y-m-d"|required|date',
            'fecha_fin'=>'date_format:"Y-m-d"|required|date',
            'id_actividad' => 'required',

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
                ->where('id', '!=', request('id_actividad'))
                ->get();

            $fecha_ini=request('fecha_inicio');
            $fecha_finn=request('fecha_fin');
            //funcion que valida las fechas a insertar en la base de dato hay que colocar esta funcion en las actividades qe
            //no son tan frecuentes y hay que hacer la funcion para os planes de trabajos que son frecuentes
            $respuesta=$this->validarQuenoExistanFechasRepetidadEnLaBase($fechas_base_datos,$fecha_ini,$fecha_finn);

            if($respuesta>0){

                return response()->json (["Ya existen estas fechas registradas en esta actividad con este plan de trabajo en la base de datos."],400);

            }else{
                $actividad = Julienne::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
                if($actividad!= null){
                    $actividad->fecha_inicio = request('fecha_inicio');
                    $actividad->fecha_fin = request('fecha_fin').' '.'23:59:00';
                    $actividad->id_estado = 1;
                    $actividad->id_prioridad = request('id_prioridad');
                    $actividad->update();
                    return response()->json('Actividad actualizada con exito',200);
                }
                return response()->json(['Actividad no encontrada'],400);       
            }

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }
    public function update_libro_vencimientos(Request $request){

        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required|numeric',
            'id_plan_trabajo'=>'required|numeric',
            'fecha_inicio'=>'date_format:"Y-m-d"|required|date',
            'fecha_fin'=>'date_format:"Y-m-d"|required|date',
            'id_actividad' => 'required',
        ]);
        if($validator->fails())
        {
          return response()->json( $errors=$validator->errors()->all(),400 );
        }

        else
        {

            $fecha= date('Y-m-d');

                if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){

                    $fechas_base_datos=DB::table('libro_vencimientos')
                ->select('fecha_inicio','id_plan_trabajo','fecha_fin')
                ->where('id_plan_trabajo',request('id_plan_trabajo'))
                ->where('id', '!=', request('id_actividad'))
                ->get();

            $fecha_ini=request('fecha_inicio');
            $fecha_finn=request('fecha_fin');
            //funcion que valida las fechas a insertar en la base de dato hay que colocar esta funcion en las actividades qe
            //no son tan frecuentes y hay que hacer la funcion para os planes de trabajos que son frecuentes
            $respuesta=$this->validarQuenoExistanFechasRepetidadEnLaBase($fechas_base_datos,$fecha_ini,$fecha_finn);

            if($respuesta>0){

                return response()->json (["Ya existen estas fechas registradas en esta actividad con este plan de trabajo en la base de datos."],400);

            }else{
                $actividad = LibroVencimientos::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
                if($actividad!= null){
                    $actividad->fecha_inicio = request('fecha_inicio');
                    $actividad->fecha_fin = request('fecha_fin').' '.'23:59:00';
                    $actividad->id_estado = 1;
                    $actividad->id_prioridad = request('id_prioridad');
                    $actividad->update();
                    return response()->json('Actividad actualizada con exito',200);
                }
                return response()->json(['Actividad no encontrada'],400); 
            }
                   

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }   
    public function update_productos_bonificados(Request $request){

        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required|numeric',
            'id_plan_trabajo'=>'required|numeric',
            'fecha_inicio'=>'date_format:"Y-m-d"|required|date',
            'fecha_fin'=>'date_format:"Y-m-d"|required|date',
            'id_actividad' => 'required',
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
                ->where('id', '!=', request('id_actividad'))
                ->get();

            $fecha_ini=request('fecha_inicio');
            $fecha_finn=request('fecha_fin');
            //funcion que valida las fechas a insertar en la base de dato hay que colocar esta funcion en las actividades qe
            //no son tan frecuentes y hay que hacer la funcion para os planes de trabajos que son frecuentes
            $respuesta=$this->validarQuenoExistanFechasRepetidadEnLaBase($fechas_base_datos,$fecha_ini,$fecha_finn);

            if($respuesta>0){

                return response()->json (["Ya existen estas fechas registradas en esta actividad con este plan de trabajo en la base de datos."],400);

            }else{
                $actividad = ProductosBonificados::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
                if($actividad!= null){
                    $actividad->fecha_inicio = request('fecha_inicio');
                    $actividad->fecha_fin = request('fecha_fin').' '.'23:59:00';
                    $actividad->id_estado = 1;
                    $actividad->id_prioridad = request('id_prioridad');
                    $actividad->update();
                    return response()->json('Actividad actualizada con exito',200);
                }
                return response()->json(['Actividad no encontrada'],400);
            }

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }
    public function update_programa_mercadeo(Request $request){

        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required|numeric',
            'id_plan_trabajo'=>'required|numeric',
            'fecha_inicio'=>'date_format:"Y-m-d"|required|date',
            'fecha_fin'=>'date_format:"Y-m-d"|required|date',
            'id_actividad' => 'required',
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
                ->where('id', '!=', request('id_actividad'))
                ->get();

            $fecha_ini=request('fecha_inicio');
            $fecha_finn=request('fecha_fin');
            //funcion que valida las fechas a insertar en la base de dato hay que colocar esta funcion en las actividades qe
            //no son tan frecuentes y hay que hacer la funcion para os planes de trabajos que son frecuentes
            $respuesta=$this->validarQuenoExistanFechasRepetidadEnLaBase($fechas_base_datos,$fecha_ini,$fecha_finn);

            if($respuesta>0){

                return response()->json (["Ya existen estas fechas registradas en esta actividad con este plan de trabajo en la base de datos."],400);

            }else{
                $actividad = ProgramaMercadeo::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
                if($actividad!= null){
                    $actividad->fecha_inicio = request('fecha_inicio');
                    $actividad->fecha_fin = request('fecha_fin').' '.'23:59:00';
                    $actividad->id_estado = 1;
                    $actividad->id_prioridad = request('id_prioridad');
                    $actividad->update();
                    return response()->json('Actividad actualizada con exito',200);
                }
                return response()->json(['Actividad no encontrada'],400);
            }

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }
    public function update_relacion_servicios_publicos(Request $request){

        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required|numeric',
            'id_plan_trabajo'=>'required|numeric',
            'fecha_inicio'=>'date_format:"Y-m-d"|required|date',
            'fecha_fin'=>'date_format:"Y-m-d"|required|date',
            'id_actividad' => 'required',
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
                ->where('id', '!=', request('id_actividad'))
                ->get();

            $fecha_ini=request('fecha_inicio');
            $fecha_finn=request('fecha_fin');
            //funcion que valida las fechas a insertar en la base de dato hay que colocar esta funcion en las actividades qe
            //no son tan frecuentes y hay que hacer la funcion para os planes de trabajos que son frecuentes
            $respuesta=$this->validarQuenoExistanFechasRepetidadEnLaBase($fechas_base_datos,$fecha_ini,$fecha_finn);

            if($respuesta>0){

                return response()->json (["Ya existen estas fechas registradas en esta actividad con este plan de trabajo en la base de datos."],400);

            }else{
                $actividad = RelacionServiciosPublicos::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
                if($actividad!= null){
                    $actividad->fecha_inicio = request('fecha_inicio');
                    $actividad->fecha_fin = request('fecha_fin').' '.'23:59:00';
                    $actividad->id_estado = 1;
                    $actividad->id_prioridad = request('id_prioridad');
                    $actividad->update();
                    return response()->json('Actividad actualizada con exito',200);
                }
                return response()->json(['Actividad no encontrada'],400);
            }

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }
    public function update_relacion_vendedores(Request $request){

        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required|numeric',
            'id_plan_trabajo'=>'required|numeric',
            'fecha_inicio'=>'date_format:"Y-m-d"|required|date',
            'fecha_fin'=>'date_format:"Y-m-d"|required|date',
            'id_actividad' => 'required',
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
                ->where('id', '!=', request('id_actividad'))
                ->get();

            $fecha_ini=request('fecha_inicio');
            $fecha_finn=request('fecha_fin');
            //funcion que valida las fechas a insertar en la base de dato hay que colocar esta funcion en las actividades qe
            //no son tan frecuentes y hay que hacer la funcion para os planes de trabajos que son frecuentes
            $respuesta=$this->validarQuenoExistanFechasRepetidadEnLaBase($fechas_base_datos,$fecha_ini,$fecha_finn);

            if($respuesta>0){

                return response()->json (["Ya existen estas fechas registradas en esta actividad con este plan de trabajo en la base de datos."],400);

            }else{
                $actividad = RelacionVendedores::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
                if($actividad!= null){
                    $actividad->fecha_inicio = request('fecha_inicio');
                    $actividad->fecha_fin = request('fecha_fin').' '.'23:59:00';
                    $actividad->id_estado = 1;
                    $actividad->id_prioridad = request('id_prioridad');
                    $actividad->update();
                    return response()->json('Actividad actualizada con exito',200);
                }
                return response()->json(['Actividad no encontrada'],400);
            }

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }
    public function update_remisiones(Request $request){

        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required|numeric',
            'id_plan_trabajo'=>'required|numeric',
            'fecha_inicio'=>'date_format:"Y-m-d"|required|date',
            'fecha_fin'=>'date_format:"Y-m-d"|required|date',
            'id_actividad' => 'required',
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
                ->where('id', '!=', request('id_actividad'))
                ->get();

            $fecha_ini=request('fecha_inicio');
            $fecha_finn=request('fecha_fin');
            //funcion que valida las fechas a insertar en la base de dato hay que colocar esta funcion en las actividades qe
             //no son tan frecuentes y hay que hacer la funcion para os planes de trabajos que son frecuentes
            $respuesta=$this->validarQuenoExistanFechasRepetidadEnLaBase($fechas_base_datos,$fecha_ini,$fecha_finn);

            if($respuesta>0){

                return response()->json (["Ya existen estas fechas registradas en esta actividad con este plan de trabajo en la base de datos."],400);

            }else{
                $actividad = Remisiones::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
                if($actividad!= null){
                    $actividad->fecha_inicio = request('fecha_inicio');
                    $actividad->fecha_fin = request('fecha_fin').' '.'23:59:00';
                    $actividad->id_estado = 1;
                    $actividad->id_prioridad = request('id_prioridad');
                    $actividad->update();
                    return response()->json('Actividad actualizada con exito',200);
                }
                return response()->json(['Actividad no encontrada'],400);
            }

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }
    public function update_servicio_bodega(Request $request){

        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required|numeric',
            'id_plan_trabajo'=>'required|numeric',
            'fecha_inicio'=>'date_format:"Y-m-d"|required|date',
            'fecha_fin'=>'date_format:"Y-m-d"|required|date',
            'id_actividad' => 'required',
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
                ->where('id', '!=', request('id_actividad'))
                ->get();

            $fecha_ini=request('fecha_inicio');
            $fecha_finn=request('fecha_fin');
            //funcion que valida las fechas a insertar en la base de dato hay que colocar esta funcion en las actividades qe
            //no son tan frecuentes y hay que hacer la funcion para os planes de trabajos que son frecuentes
            $respuesta=$this->validarQuenoExistanFechasRepetidadEnLaBase($fechas_base_datos,$fecha_ini,$fecha_finn);

            if($respuesta>0){

                return response()->json (["Ya existen estas fechas registradas en esta actividad con este plan de trabajo en la base de datos."],400);

            }else{
                $actividad = ServicioBodega::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
                if($actividad!= null){
                    $actividad->fecha_inicio = request('fecha_inicio');
                    $actividad->fecha_fin = request('fecha_fin').' '.'23:59:00';
                    $actividad->id_estado = 1;
                    $actividad->id_prioridad = request('id_prioridad');
                    $actividad->update();
                    return response()->json('Actividad actualizada con exito',200);
                }
                return response()->json(['Actividad no encontrada'],400);
            }

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }
    public function update_uso_institucional(Request $request){

        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required|numeric',
            'id_plan_trabajo'=>'required|numeric',
            'fecha_inicio'=>'date_format:"Y-m-d"|required|date',
            'fecha_fin'=>'date_format:"Y-m-d"|required|date',
            'id_actividad' => 'required',
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
                ->where('id', '!=', request('id_actividad'))
                ->get();

            $fecha_ini=request('fecha_inicio');
            $fecha_finn=request('fecha_fin');
            //funcion que valida las fechas a insertar en la base de dato hay que colocar esta funcion en las actividades qe
            //no son tan frecuentes y hay que hacer la funcion para os planes de trabajos que son frecuentes
            $respuesta=$this->validarQuenoExistanFechasRepetidadEnLaBase($fechas_base_datos,$fecha_ini,$fecha_finn);

            if($respuesta>0){

                return response()->json (["Ya existen estas fechas registradas en esta actividad con este plan de trabajo en la base de datos."],400);

            }else{
                $actividad = UsoInstitucional::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
                if($actividad!= null){
                    $actividad->fecha_inicio = request('fecha_inicio');
                    $actividad->fecha_fin = request('fecha_fin').' '.'23:59:00';
                    $actividad->id_estado = 1;
                    $actividad->id_prioridad = request('id_prioridad');
                    $actividad->update();
                    return response()->json('Actividad actualizada con exito',200);
                }
                return response()->json(['Actividad no encontrada'],400);
            }

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }
    public function update_libros_faltantes(Request $request)
    {

        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required',
            'id_plan_trabajo'=>'required',
            'fecha_inicio'=>'date_format:"Y-m-d"|required|date',
            'fecha_fin'=>'date_format:"Y-m-d"|required|date',
            'id_actividad' => 'required',
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
                ->where('id', '!=', request('id_actividad'))
                ->get();

            $fecha_ini=request('fecha_inicio');
            $fecha_finn=request('fecha_fin');
            //funcion que valida las fechas a insertar en la base de dato hay que colocar esta funcion en las actividades qe
            //no son tan frecuentes y hay que hacer la funcion para os planes de trabajos que son frecuentes
            $respuesta=$this->validarQuenoExistanFechasRepetidadEnLaBase($fechas_base_datos,$fecha_ini,$fecha_finn);


            if($respuesta>0){

                return response()->json (["Ya existen estas fechas registradas en esta actividad con este plan de trabajo en la base de datos."],400);

            }else{
                $actividad = LibrosFaltantes::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
                if($actividad!= null){
                    $actividad->fecha_inicio = request('fecha_inicio');
                    $actividad->fecha_fin = request('fecha_fin').' '.'23:59:00';
                    $actividad->id_estado = 1;
                    $actividad->id_prioridad = request('id_prioridad');
                    $actividad->update();
                    return response()->json('Actividad actualizada con exito',200);
                }
                return response()->json(['Actividad no encontrada'],400);
            }

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }
    public function update_ptc(Request $request){

            //imporante el id del plana detrabajo debe estar creado a la hora de crear las actividades a dicho plan de trabajo
    
            $validator=\Validator::make($request->all(),[
                'id_prioridad' => 'required|numeric',
                'id_plan_trabajo'=>'required|numeric',
                'id_actividad'=>'required|numeric',
                'titulo'=>'required',
                'descripcion_ptc'=>'required',
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
    
    
                    $fechas_base_datos=DB::table('actividades_ptc')
            ->select('fecha_inicio','id_plan_trabajo','fecha_fin')
            ->where('id_plan_trabajo',request('id_plan_trabajo'))
                ->where('id', '!=', request('id_actividad'))
                ->get();
    
            $fecha_ini=request('fecha_inicio');
            $fecha_finn=request('fecha_fin');
            //funcion que valida las fechas a insertar en la base de dato hay que colocar esta funcion en las actividades qe
            //no son tan frecuentes y hay que hacer la funcion para os planes de trabajos que son frecuentes
            $respuesta=$this->validarQuenoExistanFechasRepetidadEnLaBase($fechas_base_datos,$fecha_ini,$fecha_finn);
    
    
            if($respuesta>0){
    
                return response()->json (["Ya existen estas fechas registradas en esta actividad con este plan de trabajo en la base de datos."],400);
    
            }else{
                $actividad = ActividadPtc::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
                if($actividad!= null){
                    $actividad->fecha_inicio = request('fecha_inicio');
                    $actividad->titulo = request('titulo');
                    $actividad->fecha_fin = request('fecha_fin').' '.'23:59:00';
                    $actividad->id_estado = 1;
                    $actividad->id_prioridad = request('id_prioridad');
                    $actividad->descripcion_ptc = request('descripcion_ptc');
                    $actividad->update();
                    return response()->json('Actividad actualizada con exito', 200);
                }else{
                    return response()->json(['Actividad no encontrada'],400);
                }
            
            }
    
                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);
    
                }
    
    
    
            }
    
    }
    
}
