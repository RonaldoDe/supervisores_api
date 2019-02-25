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

                $respuesta=$this->validarFechasSucursal(request('id_plan_trabajo'),request('fecha_inicio'),request('fecha_fin'), 'apertura');



        if($respuesta>0){

            $actividad = Apertura::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
            if($actividad!= null){
                $actividad->fecha_inicio = request('fecha_inicio');
                $actividad->fecha_fin = request('fecha_fin').' '.'23:59:00';
                $actividad->id_estado = 1;
                $actividad->update();
                return response()->json('Actividad actualizada con exito',200);
            }
            return response()->json(['Actividad no encontrada'],400);
        }else{
            return response()->json(['Las fechas se encunetra en el rango de fechas de otra actividad igual en Apertura'],400);

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
    
    
                $respuesta=$this->validarFechasSucursal(request('id_plan_trabajo'),request('fecha_inicio'),request('fecha_fin'), 'documentacion_legal');

    
                if($respuesta>0){
    
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
    
                }else{
            return response()->json(['Las fechas se encunetra en el rango de fechas de otra actividad igual en Documentación legal'],400);

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

                    $respuesta=$this->validarFechasSucursal(request('id_plan_trabajo'),request('fecha_inicio'),request('fecha_fin'), 'arqueo_caja');


            if($respuesta>0){
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
            }else{
                return response()->json(['Las fechas se encunetra en el rango de fechas de otra actividad igual en Arqueo de caja'],400);

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

                $respuesta=$this->validarFechasSucursal(request('id_plan_trabajo'),request('fecha_inicio'),request('fecha_fin'), 'condiciones_locativas');


        if($respuesta>0){

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
        }else{
            return response()->json(['Las fechas se encunetra en el rango de fechas de otra actividad igual en Condiciones locativas'],400);

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

                    $respuesta=$this->validarFechasSucursal(request('id_plan_trabajo'),request('fecha_inicio'),request('fecha_fin'), 'domicilios');


            if($respuesta>0){
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
            }else{
                return response()->json(['Las fechas se encunetra en el rango de fechas de otra actividad igual en Domicilios'],400);

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

                $respuesta=$this->validarFechasSucursal(request('id_plan_trabajo'),request('fecha_inicio'),request('fecha_fin'), 'envio_correspondencia');


            if($respuesta>0){

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
            }else{
                return response()->json(['Las fechas se encunetra en el rango de fechas de otra actividad igual en Envio correspondencia'],400);

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

                $respuesta=$this->validarFechasSucursal(request('id_plan_trabajo'),request('fecha_inicio'),request('fecha_fin'), 'evolucion_clientes');


            if($respuesta>0){

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
            }else{
                return response()->json(['Las fechas se encunetra en el rango de fechas de otra actividad igual en Evolucion clientes'],400);

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

                    $respuesta=$this->validarFechasSucursal(request('id_plan_trabajo'),request('fecha_inicio'),request('fecha_fin'), 'examen_gimed');



            if($respuesta>0){

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
            }else{
                return response()->json(['Las fechas se encunetra en el rango de fechas de otra actividad igual en Examen gimed'],400);

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

                    $respuesta=$this->validarFechasSucursal(request('id_plan_trabajo'),request('fecha_inicio'),request('fecha_fin'), 'exhibiciones');


            if($respuesta>0){

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
            }else{
                return response()->json(['Las fechas se encunetra en el rango de fechas de otra actividad igual en Exhibiciones'],400);

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

                    $respuesta=$this->validarFechasSucursal(request('id_plan_trabajo'),request('fecha_inicio'),request('fecha_fin'), 'facturacion');


            if($respuesta>0){

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
            }else{
                return response()->json(['Las fechas se encunetra en el rango de fechas de otra actividad igual en Facturación'],400);

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

                    $respuesta=$this->validarFechasSucursal(request('id_plan_trabajo'),request('fecha_inicio'),request('fecha_fin'), 'gimed');


            if($respuesta>0){
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
            }else{
                return response()->json(['Las fechas se encunetra en el rango de fechas de otra actividad igual en Gimed'],400);

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

                    $respuesta=$this->validarFechasSucursal(request('id_plan_trabajo'),request('fecha_inicio'),request('fecha_fin'), 'kardex');


            if($respuesta>0){

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
            }else{
                return response()->json(['Las fechas se encunetra en el rango de fechas de otra actividad igual en Kardex'],400);

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

                    $respuesta=$this->validarFechasSucursal(request('id_plan_trabajo'),request('fecha_inicio'),request('fecha_fin'), 'inventario_mercancia');


            if($respuesta>0){

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
            }else{
                return response()->json(['Las fechas se encunetran en el rango de fechas de otra actividad igual en Inventario de mercancia'],400);

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

                    $respuesta=$this->validarFechasSucursal(request('id_plan_trabajo'),request('fecha_inicio'),request('fecha_fin'), 'julienne');
                    

            if($respuesta>0){
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
            }else{
                return response()->json(['Las fechas se encunetran en el rango de fechas de otra actividad igual en Julienne'],400);

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

                    $respuesta=$this->validarFechasSucursal(request('id_plan_trabajo'),request('fecha_inicio'),request('fecha_fin'), 'libro_vencimientos');


            if($respuesta>0){
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
            }else{
                return response()->json(['Las fechas se encunetran en el rango de fechas de otra actividad igual en Libro de vencimientos'],400);

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

                    $respuesta=$this->validarFechasSucursal(request('id_plan_trabajo'),request('fecha_inicio'),request('fecha_fin'), 'productos_bonificados');


            if($respuesta>0){

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
            }else{
                return response()->json(['Las fechas se encunetran en el rango de fechas de otra actividad igual en Productos bonificados'],400);

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

                    $respuesta=$this->validarFechasSucursal(request('id_plan_trabajo'),request('fecha_inicio'),request('fecha_fin'), 'programa_mercadeo');


            if($respuesta>0){

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
            }else{
                return response()->json(['Las fechas se encunetran en el rango de fechas de otra actividad igual en Programa de mercadeo'],400);

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

                    $respuesta=$this->validarFechasSucursal(request('id_plan_trabajo'),request('fecha_inicio'),request('fecha_fin'), 'relacion_servicios_publicos');
                   

            if($respuesta>0){

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
            }else{
                return response()->json(['Las fechas se encunetran en el rango de fechas de otra actividad igual en Relacion de servicios publicos'],400);

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

                    $respuesta=$this->validarFechasSucursal(request('id_plan_trabajo'),request('fecha_inicio'),request('fecha_fin'), 'relacion_vendedores');


            if($respuesta>0){
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
            }else{
                return response()->json(['Las fechas se encunetran en el rango de fechas de otra actividad igual en Relacion de vendedores'],400);
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

                    $respuesta=$this->validarFechasSucursal(request('id_plan_trabajo'),request('fecha_inicio'),request('fecha_fin'), 'relacion_vendedores');
                   

            if($respuesta>0){
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
            }else{
                return response()->json(['Las fechas se encunetran en el rango de fechas de otra actividad igual en Remisiones'],400);

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

                    $respuesta=$this->validarFechasSucursal(request('id_plan_trabajo'),request('fecha_inicio'),request('fecha_fin'), 'servicio_bodega');


            if($respuesta>0){
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
            }else{
                return response()->json(['Las fechas se encunetran en el rango de fechas de otra actividad igual en Servicio de bodega'],400);

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

                    $respuesta=$this->validarFechasSucursal(request('id_plan_trabajo'),request('fecha_inicio'),request('fecha_fin'), 'uso_institucional');


            if($respuesta>0){

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
            }else{
                return response()->json(['Las fechas se encunetran en el rango de fechas de otra actividad igual en Uso institucional'],400);

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

                    $respuesta=$this->validarFechasSucursal(request('id_plan_trabajo'),request('fecha_inicio'),request('fecha_fin'), 'libros_faltantes');
                   


            if($respuesta>0){
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
            }else{
                return response()->json(['Las fechas se encunetran en el rango de fechas de otra actividad igual en Libro de faltantes'],400);

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
                'fecha_fin'=>'date_format:"Y-m-d"|required',
                'data'=>'required',
    
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
    

                $actividad = ActividadPtc::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
                if($actividad!= null){
                    $actividad->fecha_inicio = request('fecha_inicio');
                    $actividad->titulo = request('titulo');
                    $actividad->fecha_fin = request('fecha_fin').' '.'23:59:00';
                    $actividad->id_estado = 1;
                    $actividad->id_prioridad = request('id_prioridad');
                    $actividad->data = request('data');
                    $actividad->descripcion_ptc = request('descripcion_ptc');
                    $actividad->update();
                    return response()->json('Actividad actualizada con exito', 200);
                }else{
                    return response()->json(['Actividad no encontrada'],400);
                }
            
            
    
                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);
    
                }
    
    
    
            }
    
    }
    
}
