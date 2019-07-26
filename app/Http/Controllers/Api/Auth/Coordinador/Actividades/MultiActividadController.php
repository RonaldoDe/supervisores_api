<?php

namespace App\Http\Controllers\Api\Auth\Coordinador\Actividades;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modelos\Actividades\Apertura;
use App\Modelos\Actividades\CondicionesLocativas;
use App\Modelos\Actividades\Remisiones;
use App\Modelos\Actividades\Kardex;
use App\Modelos\Actividades\LibrosFaltantes;
use App\Modelos\Actividades\LibroVencimientos;
use App\Modelos\Actividades\DocumentacionLegal;
use App\Modelos\Notificaciones;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Modelos\Actividades\Detalles\CondicionesDetalle;
use App\Modelos\Actividades\Detalles\Documentacion;
use App\Modelos\Actividades\ActividadPtc;
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
use App\Modelos\Actividades\ProductosBonificados;
use App\Modelos\Actividades\ProgramaMercadeo;
use App\Modelos\Actividades\RelacionServiciosPublicos;
use App\Modelos\Actividades\RelacionVendedores;
use App\Modelos\Actividades\ServicioBodega;
use App\Modelos\Actividades\UsoInstitucional;
use App\Modelos\Actividades\Compromiso;
use App\Modelos\Actividades\Senalizacion;
use App\Modelos\Actividades\ContratoAnexosLegalizacion;
use App\Modelos\Actividades\SolicitudSeguro;
class MultiActividadController extends Controller
{

    //funciones para crear las actividades multiple

    /* 
        (1)Cada funcion recoge el id del plan de trabajo, la fecha inicio y fecha fin de la actividad, luego valida que los request llegen
        (2)valida que la fecha inicio sea mayor que la fecha actual y que la fecha fin
        (4)instancia del modelo de una actividad para crearla respectivamente
    */

    public function apertura(Request $request)
    {
        /*(1)*/
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
            /*(2)*/
            if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){

              
                /*(4)*/
                $apertura =Apertura::create([

                    'id_plan_trabajo' =>request('id_plan_trabajo'),
                    'fecha_inicio' =>request('fecha_inicio'),
                    'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                    'observacion'=>'',
                    'id_prioridad' =>1,
                    'id_estado' =>1,

                ]);
             // DB::commit();
                }
                else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }


    }

    public function documentacion_legal(Request $request){

        //imporante el id del plana detrabajo debe estar creado a la hora de crear las actividades a dicho plan de trabajo
        /*(1)*/
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
            /*(2)*/
            if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){
                    /*(4)*/
                    $documentacion_legal =DocumentacionLegal::create([
    
                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>1,
                        'id_estado' => 1,
    
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
    
   
            }else{
                return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);
    
            }
    
    
    
        }
    
    }

    public function arqueo_caja(Request $request){
        /*(1)*/
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
                /*(2)*/
                if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){

                    /*(4)*/
                    $arqueo_caja =ArqueoCaja::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>1,
                        'id_estado' =>1,

                    ]);

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }



            }
    }

    public function domicilios(Request $request){
        /*(1)*/
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

                /*(2)*/
                if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){

                  
                    /*(4)*/
                    $domicilios =Domicilio::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>1,
                        'id_estado' =>1,

                    ]);

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }

            }
    }

    public function envio_correspondencia(Request $request){
            /*(1)*/
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
            /*(2)*/
            if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){
                    /*(4)*/
                    $envio_correspondencia =EnvioCorrespondencia::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>1,
                        'id_estado' =>1,

                    ]);
            

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }

            }
    }

    public function evolucion_clientes(Request $request){
        /*(1)*/
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
            /*(2)*/
                if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){

                    /*(4)*/
                    $evolucion_pedido =EvolucionClientes::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>1,
                        'id_estado' =>1,

                    ]);
            

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }



            }
    }

    public function examen_gimed(Request $request){
        /*(1)*/
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
                /*(2)*/
                if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){
                    /*(4)*/
                    $examen_gimed =ExamenGimed::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>1,
                        'id_estado' =>1,

                    ]);
            

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }



            }
    }

    public function exhibiciones(Request $request){
        /*(1)*/
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
                /*(2)*/
                if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){

                    /*(4)*/
                    $exhibiciones =Exhibiciones::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>1,
                        'id_estado' =>1,

                    ]);
            

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }

            }
    }

    public function facturacion(Request $request){
        /*(1)*/
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
                /*(2)*/
                if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){

                    /*(4)*/
                    $facturacion =Facturacion::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>1,
                        'id_estado' =>1,

                    ]);
 
                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }

    public function gimed(Request $request){
        /*(1)*/
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
                /*(2)*/
                if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){

                    /*(4)*/
                    $gimed =Gimed::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>1,
                        'id_estado' =>1,

                    ]);
            

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }

    public function inventario_mercancia(Request $request){
        /*(1)*/
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
                /*(2)*/
                if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){

                    /*(4)*/
                    $inventario_mercancia =InventarioMercancia::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>1,
                        'id_estado' =>1,

                    ]);
            
                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }

    public function julienne(Request $request){
        /*(1)*/
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
                /*(2)*/
                if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){

                    /*(4)*/
                    $julienne =Julienne::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>1,
                        'id_estado' =>1,

                    ]);
            
                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }

    public function libro_vencimientos(Request $request){
        /*(1)*/
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
                /*(2)*/
                if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){

                    /*(4)*/
                    $libro_vencimiento =LibroVencimientos::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>1,
                        'id_estado' =>1,

                    ]);
            

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }

    public function productos_bonificados(Request $request){
        /*(1)*/
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
                /*(2)*/
                if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){

                   /*(4)*/
                    $productos_bonificados =ProductosBonificados::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>1,
                        'id_estado' =>1,

                    ]);
            

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }

    public function programa_mercadeo(Request $request){
        /*(1)*/
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
                /*(2)*/
                if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){

                   /*(4)*/
                    $programa_mercadeo =ProgramaMercadeo::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>1,
                        'id_estado' =>1,

                    ]);
 
                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }

    public function relacion_servicios_publicos(Request $request){
        /*(1)*/
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
                /*(2)*/
                if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){
                    /*(4)*/
                    $relacion_servicios_publicos =RelacionServiciosPublicos::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>1,
                        'id_estado' =>1,

                    ]);

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }

    public function relacion_vendedores(Request $request){
        /*(1)*/
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
                /*(2)*/
                if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){

                    /*(4)*/
                    $relacion_vendedores =RelacionVendedores::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>1,
                        'id_estado' =>1,

                    ]);
            

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }

    public function remisiones(Request $request){
        /*(1)*/
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
            /*(2)*/
            if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){

 
                /*(4)*/
                $remisiones =Remisiones::create([
                    'id_plan_trabajo' =>request('id_plan_trabajo'),
                    'fecha_inicio' =>request('fecha_inicio'),
                    'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                    'observacion'=>'',
                    'id_prioridad' =>1,
                    'id_estado' =>1,

                ]);
        
                }
                else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }

            }

    }

    public function servicio_bodega(Request $request){
        /*(1)*/
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
                /*(2)*/
                if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){

                   /*(4)*/
                    $servicio_bodega =ServicioBodega::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>1,
                        'id_estado' =>1,

                    ]);
            

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }

    public function uso_institucional(Request $request){
        /*(1)*/
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
                /*(2)*/
                if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){

                   /*(4)*/
                    $uso_institucional =UsoInstitucional::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>1,
                        'id_estado' =>1,

                    ]);
            

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }

    public function condiciones_locativas(Request $request){

        /*(1)*/
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
            /*(2)*/
            if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){


                /*(4)*/
                $condiciones_locativas =CondicionesLocativas::create([

                    'id_plan_trabajo' =>request('id_plan_trabajo'),
                    'fecha_inicio' =>request('fecha_inicio'),
                    'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                    'observacion'=>'',
                    'id_prioridad' =>1,
                    'id_estado' =>1,

                ]);
                //iterar y obtener las condiciones locaivas
                if($condiciones_locativas){
                    $condiciones = DB::table('lista_condiciones_locativas')
                    ->get();
                    //crear la lista de condiciones locativas con su respectiva actividad
                    foreach ($condiciones as $condicion) {
                        $condicion =CondicionesDetalle::create([
                            'id_actividad' =>$condiciones_locativas->id,
                            'id_condicion' =>$condicion->id,
                        ]);
                    }
                }else{
                    return response()->json(["success"=>"Actividad no encontrada o error al crearla."],400);

                }
        }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
        }



    }

    public function kardex(Request $request){
        /*(1)*/
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
            /*(2)*/
            if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){

               
                /*(4)*/
                $kardex =Kardex::create([
                    'id_plan_trabajo' =>request('id_plan_trabajo'),
                    'fecha_inicio' =>request('fecha_inicio'),
                    'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                    'observacion'=>'',
                    'id_prioridad' =>1,
                    'id_estado' =>1,

                ]);

            }else{
                return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

            }
        }
    }

    public function libros_faltantes(Request $request){
        /*(1)*/
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
            /*(2)*/
            if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){
                /*(4)*/
                $libroFaltante =LibrosFaltantes::create([
                    'id_plan_trabajo' =>request('id_plan_trabajo'),
                    'fecha_inicio' =>request('fecha_inicio'),
                    'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                    'observacion'=>'',
                    'id_prioridad' =>1,
                    'id_estado' =>1,

                ]);
 
                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }

    public function compromisos(Request $request){
        /*(1)*/
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
            /*(2)*/
            if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){

                /*(4)*/
                $compromisos =Compromiso::create([
                    'id_plan_trabajo' =>request('id_plan_trabajo'),
                    'fecha_inicio' =>request('fecha_inicio'),
                    'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                    'observacion'=>'',
                    'id_prioridad' =>1,
                    'id_estado' =>1,

                ]);
                
        
                // DB::commit();

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }

    public function senalizacion(Request $request){
        /*(1)*/
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
            /*(2)*/
            if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){

                /*(4)*/
                $senalizacion =Senalizacion::create([
                    'id_plan_trabajo' =>request('id_plan_trabajo'),
                    'fecha_inicio' =>request('fecha_inicio'),
                    'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                    'observacion'=>'',
                    'id_prioridad' =>1,
                    'id_estado' =>1,

                ]);
                
        
                // DB::commit();

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }
    
    public function contratos_anexos_legalizacion(Request $request){
        /*(1)*/
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
            /*(2)*/
            if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){

                /*(4)*/
                $contratos =ContratoAnexosLegalizacion::create([
                    'id_plan_trabajo' =>request('id_plan_trabajo'),
                    'fecha_inicio' =>request('fecha_inicio'),
                    'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                    'observacion'=>'',
                    'id_prioridad' =>1,
                    'id_estado' =>1,

                ]);
                
        
                // DB::commit();

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }

    public function solicitud_seguro(Request $request){
        /*(1)*/
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
            /*(2)*/
            if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){

                /*(4)*/
                $solicitud =SolicitudSeguro::create([
                    'id_plan_trabajo' =>request('id_plan_trabajo'),
                    'fecha_inicio' =>request('fecha_inicio'),
                    'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                    'observacion'=>'',
                    'id_prioridad' =>1,
                    'id_estado' =>1,

                ]);
                
        
                // DB::commit();

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }

    public function actividades_ptc(Request $request){

        //imporante el id del plana detrabajo debe estar creado a la hora de crear las actividades a dicho plan de trabajo
        /*(1)*/
        $validator=\Validator::make($request->all(),[
            'titulo' => 'required',
            'id_plan_trabajo'=>'required|numeric',
            'fecha_inicio'=>'date_format:"Y-m-d"|required',
            'fecha_fin'=>'date_format:"Y-m-d"|required',
            'data' => 'required',
            'descripcion' => 'required'
        ]);
        if($validator->fails())
        {
          return response()->json( $errors=$validator->errors()->all(),400 );
        }

        else
        {

            $fecha= date('Y-m-d');
            /*(2)*/
            if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){

                /*(4)*/
                $ptc =ActividadPtc::create([

                    'id_plan_trabajo' =>request('id_plan_trabajo'),
                    'titulo' =>request('titulo'),
                    'fecha_inicio' =>request('fecha_inicio'),
                    'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                    'observacion'=>'',
                    'id_prioridad' =>1,
                    'id_estado' =>1,
                    'data' =>request('data'),
                    'descripcion_ptc' =>request('descripcion'),

                ]);
        
            }else{
                return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

            }


        }

    }

}
