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
use App\Modelos\Actividades\CondicionesLocativas;
use App\Modelos\Actividades\DocumentacionLegal;
use App\Modelos\Actividades\ActividadPtc;
use App\Modelos\Actividades\Compromiso;
use App\Modelos\Actividades\Senalizacion;
use App\Modelos\Actividades\ContratoAnexosLegalizacion;
use App\Modelos\Actividades\SolicitudSeguro;

class CrearActividadesPlanController extends Controller
{

    //funciones para crear las actividades

    /* 
        (1)Cada funcion recoge el id del plan de trabajo, la fecha inicio y fecha fin de la actividad, luego valida que los request llegen
        (2)valida que la fecha inicio sea mayor que la fecha actual y que la fecha fin
        (3)funcion que valida si existe la misma activcidad en el rango de fechas dado de la misma sucursal
        (4)instancia del modelo de una actividad para crearla respectivamente
    */


    public function crear_apertura(Request $request)
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


        /*(3)*/       
        $respuesta=$this->validarFechasSucursal(request('id_plan_trabajo'),request('fecha_inicio'),request('fecha_fin'), 'apertura');

        if($respuesta == 1){

                /*(4)*/
                $apertura =Apertura::create([

                    'id_plan_trabajo' =>request('id_plan_trabajo'),
                    'fecha_inicio' =>request('fecha_inicio'),
                    'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                    'observacion'=>'',
                    'id_prioridad' =>1,
                    'id_estado' =>1,

                ]);
                return response()->json(["success"=>" Actividad  Apertura creada", 'id' => $apertura->id],201);
        }else{
            return response()->json(['Las fechas se encuentra en el rango de fechas de otra actividad igual en Apertura'],400);

        }

                }
                else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }


    }
    public function crear_documentacion_legal(Request $request){

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
    
                /*(3)*/
                $respuesta=$this->validarFechasSucursal(request('id_plan_trabajo'),request('fecha_inicio'),request('fecha_fin'), 'documentacion_legal');
    
                if($respuesta>0){
    
                
                    /*(4)*/
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
                        //obtener la lista de documentacion legal y crear cada documento con su respectiva actividad
                        foreach ($documentos as $documento) {
                            $documentacion =Documentacion::create([
                                'id_actividad' =>$documentacion_legal->id,
                                'id_documento' =>$documento->id,
                            ]);
                        }
                        return response()->json(["success"=>" Actividad creada", 'id' => $documentacion_legal->id],201);
                    }else{
                        return response()->json(["success"=>"Actividad no encontrada o error al crearla."],400);
    
                    }
    
                }else{
                    return response()->json(['Las fechas se encuentra en el rango de fechas de otra actividad igual en Documentación legal'],400);
                }
    
    
    
            }else{
                return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);
    
            }
    
    
    
        }
    
    }
    public function crear_arqueo_caja(Request $request){
        /*(1)*/
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
                /*(2)*/
                if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){

                /*(3)*/
                $respuesta=$this->validarFechasSucursal(request('id_plan_trabajo'),request('fecha_inicio'),request('fecha_fin'), 'arqueo_caja');
                 
            if($respuesta>0){
                    /*(4)*/
                    $arqueo_caja =ArqueoCaja::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>request('id_prioridad'),
                        'id_estado' =>1,

                    ]);
            }else{
                return response()->json(['Las fechas se encuentra en el rango de fechas de otra actividad igual en Arqueo de caja'],400);
                
            }
            
            // DB::commit();
            
                    return response()->json(["success"=>" Actividad creada", 'id' => $arqueo_caja->id],201);

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }



            }
    }
    public function crear_kardex(Request $request){
        /*(1)*/
        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required|numeric',
            'id_plan_trabajo'=>'required|numeric',
            'fecha_inicio'=>'date_format:"Y-m-d"|required|date',
            'fecha_fin'=>'date_format:"Y-m-d"|required|date',
            'laboratorios'=>'required',
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
                /*(3)*/
                $respuesta=$this->validarFechasSucursal(request('id_plan_trabajo'),request('fecha_inicio'),request('fecha_fin'), 'kardex');
                    


            if($respuesta>0){
                    /*(4)*/
                    $kardex =Kardex::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>request('id_prioridad'),
                        'laboratorios_asignados' =>request('laboratorios'),
                        'id_estado' =>1,

                    ]);
            }else{
                return response()->json(['Las fechas se encuentra en el rango de fechas de otra actividad igual en Kardex'],400);
                
            }
            
            // DB::commit();
            
                    return response()->json(["success"=>" Actividad creada", 'id' => $kardex->id],201);

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }



            }
    }
    public function crear_condiciones_locativas(Request $request){

        /*(1)*/
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
            /*(2)*/
            if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){
                /*(3)*/
                $respuesta=$this->validarFechasSucursal(request('id_plan_trabajo'),request('fecha_inicio'),request('fecha_fin'), 'condiciones_locativas');



        if($respuesta>0){

                /*(4)*/
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
                        //obtener la lista de documentacion legal y crear cada documento con su respectiva actividad
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
        else{
            return response()->json(['Las fechas se encuentra en el rango de fechas de otra actividad igual en Condiciones locativas'],400);

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
        /*(1)*/
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
                /*(2)*/
                if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){
                /*(3)*/
                $respuesta=$this->validarFechasSucursal(request('id_plan_trabajo'),request('fecha_inicio'),request('fecha_fin'), 'domicilios');


            if($respuesta>0){
                    /*(4)*/
                    $domicilios =Domicilio::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>request('id_prioridad'),
                        'id_estado' =>1,

                    ]);
            }else{
                return response()->json(['Las fechas se encuentra en el rango de fechas de otra actividad igual en Domicilio'],400);

            }

                    return response()->json(["success"=>" Actividad creada", 'id' => $domicilios->id],201);

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }

            }
    }
    public function crear_envio_correspondencia(Request $request)
         {
            /*(1)*/
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
            /*(2)*/
            if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){
                /*(3)*/
                $respuesta=$this->validarFechasSucursal(request('id_plan_trabajo'),request('fecha_inicio'),request('fecha_fin'), 'envio_correspondencia');
                

            if($respuesta>0){
                    /*(4)*/
                    $envio_correspondencia =EnvioCorrespondencia::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>request('id_prioridad'),
                        'id_estado' =>1,

                    ]);
            }else{
                return response()->json(['Las fechas se encuentra en el rango de fechas de otra actividad igual en Envio de correspondencia'],400);

            }

                    return response()->json(["success"=>" Actividad creada", 'id' => $envio_correspondencia->id],201);

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }


            }

    }
    public function crear_evolucion_clientes(Request $request){
        /*(1)*/
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
                /*(2)*/
                if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){
                    /*(3)*/
                    $respuesta=$this->validarFechasSucursal(request('id_plan_trabajo'),request('fecha_inicio'),request('fecha_fin'), 'evolucion_clientes');


            if($respuesta>0){
                    /*(4)*/
                    $evolucion_pedido =EvolucionClientes::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>request('id_prioridad'),
                        'id_estado' =>1,

                    ]);
            }else{
                return response()->json(['Las fechas se encuentra en el rango de fechas de otra actividad igual en Evolucion de clientes'],400);

            }
                    return response()->json(["success"=>" Actividad creada", 'id' => $evolucion_pedido->id],201);

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }



            }
    }
    public function crear_examen_gimed(Request $request){
        /*(1)*/
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
                /*(2)*/
                if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){
                    /*(3)*/
                    $respuesta=$this->validarFechasSucursal(request('id_plan_trabajo'),request('fecha_inicio'),request('fecha_fin'), 'examen_gimed');



            if($respuesta>0){
                    /*(4)*/
                    $examen_gimed =ExamenGimed::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>request('id_prioridad'),
                        'id_estado' =>1,

                    ]);
            }else{
                return response()->json(['Las fechas se encuentra en el rango de fechas de otra actividad igual en Examen gimed'],400);

            }

                    // DB::commit();

                    return response()->json(["success"=>" Actividad creada", 'id' => $examen_gimed->id],201);

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }



            }
    }
    public function crear_exhibiciones(Request $request){
        /*(1)*/
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
                /*(2)*/
                if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){
                    /*(3)*/
                    $respuesta=$this->validarFechasSucursal(request('id_plan_trabajo'),request('fecha_inicio'),request('fecha_fin'), 'exhibiciones');


            if($respuesta>0){
                    /*(4)*/
                    $exhibiciones =Exhibiciones::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>request('id_prioridad'),
                        'id_estado' =>1,

                    ]);
            }else{
                return response()->json(['Las fechas se encuentra en el rango de fechas de otra actividad igual en Exhibiciones'],400);
            }

                    return response()->json(["success"=>" Actividad creada", 'id' => $exhibiciones->id],201);

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }

            }
    }
    public function crear_facturacion(Request $request){
        /*(1)*/
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
                /*(2)*/
                if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){
                    /*(3)*/
                    $respuesta=$this->validarFechasSucursal(request('id_plan_trabajo'),request('fecha_inicio'),request('fecha_fin'), 'facturacion');


            if($respuesta>0){
                    /*(4)*/
                    $facturacion =Facturacion::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>request('id_prioridad'),
                        'id_estado' =>1,

                    ]);
            }else{
                return response()->json(['Las fechas se encuentra en el rango de fechas de otra actividad igual en Facturación'],400);

            }
                    return response()->json(["success"=>" Actividad creada", 'id' => $facturacion->id],201);

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }
    public function crear_gimed(Request $request){
        /*(1)*/
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
                /*(2)*/
                if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){
                    /*(3)*/
                    $respuesta=$this->validarFechasSucursal(request('id_plan_trabajo'),request('fecha_inicio'),request('fecha_fin'), 'gimed');


            if($respuesta>0){
                    /*(4)*/
                    $gimed =Gimed::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>request('id_prioridad'),
                        'id_estado' =>1,

                    ]);
            }else{
                return response()->json(['Las fechas se encuentra en el rango de fechas de otra actividad igual en Gimed'],400);

            }
                    return response()->json(["success"=>" Actividad creada", 'id' => $gimed->id],201);

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }
    public function crear_inventario_mercancia(Request $request){
        /*(1)*/
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
                /*(2)*/
                if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){
                    /*(3)*/
                    $respuesta=$this->validarFechasSucursal(request('id_plan_trabajo'),request('fecha_inicio'),request('fecha_fin'), 'inventario_mercancia');
                    

            if($respuesta>0){
                    /*(4)*/
                    $inventario_mercancia =InventarioMercancia::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>request('id_prioridad'),
                        'id_estado' =>1,

                    ]);
            }else{
                return response()->json(['Las fechas se encuentra en el rango de fechas de otra actividad igual en Inventario de mercancia'],400);

            }
                    return response()->json(["success"=>" Actividad creada", 'id' => $inventario_mercancia->id],201);

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }
    public function crear_julienne(Request $request){
        /*(1)*/
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
                /*(2)*/
                if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){
                    /*(3)*/
                    $respuesta=$this->validarFechasSucursal(request('id_plan_trabajo'),request('fecha_inicio'),request('fecha_fin'), 'julienne');
                    

            if($respuesta>0){
                    /*(4)*/
                    $julienne =Julienne::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>request('id_prioridad'),
                        'id_estado' =>1,

                    ]);
            }else{
                return response()->json(['Las fechas se encuentra en el rango de fechas de otra actividad igual en Julienne'],400);

            }
                    return response()->json(["success"=>" Actividad creada", 'id' => $julienne->id],201);

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }
    public function crear_libro_vencimientos(Request $request){
        /*(1)*/
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
                /*(2)*/
                if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){
                    /*(3)*/
                    $respuesta=$this->validarFechasSucursal(request('id_plan_trabajo'),request('fecha_inicio'),request('fecha_fin'), 'libro_vencimientos');


            if($respuesta>0){
                    /*(4)*/
                    $libro_vencimiento =LibroVencimientos::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>request('id_prioridad'),
                        'id_estado' =>1,

                    ]);
            }else{
                return response()->json(['Las fechas se encuentra en el rango de fechas de otra actividad igual en Libro de vencimiento'],400);

            }
                    return response()->json(["success"=>" Actividad creada", 'id' => $libro_vencimiento->id],201);

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }   
    public function crear_productos_bonificados(Request $request){
        /*(1)*/
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
                /*(2)*/
                if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){
                    /*(3)*/
                    $respuesta=$this->validarFechasSucursal(request('id_plan_trabajo'),request('fecha_inicio'),request('fecha_fin'), 'productos_bonificados');


            if($respuesta>0){
                    /*(4)*/
                    $productos_bonificados =ProductosBonificados::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>request('id_prioridad'),
                        'id_estado' =>1,

                    ]);
            }else{
                return response()->json(['Las fechas se encuentra en el rango de fechas de otra actividad igual en Productos bonificados'],400);

            }
                    return response()->json(["success"=>" Actividad creada", 'id' => $productos_bonificados->id],201);

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }
    public function crear_programa_mercadeo(Request $request){
        /*(1)*/
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
                /*(2)*/
                if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){
                    /*(3)*/
                    $respuesta=$this->validarFechasSucursal(request('id_plan_trabajo'),request('fecha_inicio'),request('fecha_fin'), 'programa_mercadeo');
                   

            if($respuesta>0){
                    /*(4)*/
                    $programa_mercadeo =ProgramaMercadeo::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>request('id_prioridad'),
                        'id_estado' =>1,

                    ]);
            }else{
                return response()->json(['Las fechas se encuentra en el rango de fechas de otra actividad igual en Programa de mercadeo'],400);

            }
                    return response()->json(["success"=>" Actividad creada", 'id' => $programa_mercadeo->id],201);

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }
    public function crear_relacion_servicios_publicos(Request $request){
        /*(1)*/
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
                /*(2)*/
                if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){
                    /*(3)*/
                    $respuesta=$this->validarFechasSucursal(request('id_plan_trabajo'),request('fecha_inicio'),request('fecha_fin'), 'relacion_servicios_publicos');
                    

            if($respuesta>0){
                    /*(4)*/
                    $relacion_servicios_publicos =RelacionServiciosPublicos::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>request('id_prioridad'),
                        'id_estado' =>1,

                    ]);
            }else{
                return response()->json(['Las fechas se encuentra en el rango de fechas de otra actividad igual en Relación de servicios publicos'],400);

            }
                    return response()->json(["success"=>" Actividad creada", 'id' => $relacion_servicios_publicos->id],201);

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }
    public function crear_relacion_vendedores(Request $request){
        /*(1)*/
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
                /*(4)*/
                if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){
                    /*(3)*/
                    $respuesta=$this->validarFechasSucursal(request('id_plan_trabajo'),request('fecha_inicio'),request('fecha_fin'), 'relacion_vendedores');                

            if($respuesta>0){
                    /*(4)*/
                    $relacion_vendedores =RelacionVendedores::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>request('id_prioridad'),
                        'id_estado' =>1,

                    ]);
            }else{
                return response()->json(['Las fechas se encuentra en el rango de fechas de otra actividad igual en Relacion de vendedores'],400);

            }
                    return response()->json(["success"=>" Actividad creada", 'id' => $relacion_vendedores->id],201);

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }
    public function crear_remisiones(Request $request){
        /*(1)*/
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
                /*(2)*/
                if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){
                    /*(3)*/
                    $respuesta=$this->validarFechasSucursal(request('id_plan_trabajo'),request('fecha_inicio'),request('fecha_fin'), 'remisiones');                
                    

            if($respuesta>0){
                    /*(4)*/
                    $remisiones =Remisiones::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>request('id_prioridad'),
                        'id_estado' =>1,

                    ]);
            }else{
                return response()->json(['Las fechas se encuentra en el rango de fechas de otra actividad igual en Remisiones'],400);

            }

                    return response()->json(["success"=>" Actividad creada", 'id' => $remisiones->id],201);

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }
    public function crear_servicio_bodega(Request $request){
        /*(1)*/
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
                /*(2)*/
                if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){
                    /*(3)*/
                    $respuesta=$this->validarFechasSucursal(request('id_plan_trabajo'),request('fecha_inicio'),request('fecha_fin'), 'servicio_bodega');                
                   

            if($respuesta>0){
                    /*(4)*/
                    $servicio_bodega =ServicioBodega::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>request('id_prioridad'),
                        'id_estado' =>1,

                    ]);
            }else{
                return response()->json(['Las fechas se encuentra en el rango de fechas de otra actividad igual en Servicio de bodega'],400);

            }
                    return response()->json(["success"=>" Actividad creada", 'id' => $servicio_bodega->id],201);

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }
    public function crear_uso_institucional(Request $request){
        /*(1)*/
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
                /*(2)*/
                if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){
                    /*(3)*/
                    $respuesta=$this->validarFechasSucursal(request('id_plan_trabajo'),request('fecha_inicio'),request('fecha_fin'), 'uso_institucional');                


            if($respuesta>0){
                    /*(4)*/
                    $uso_institucional =UsoInstitucional::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>request('id_prioridad'),
                        'id_estado' =>1,

                    ]);
            }else{
                return response()->json(['Las fechas se encuentra en el rango de fechas de otra actividad igual en Uso institucional'],400);

            }
                    return response()->json(["success"=>" Actividad creada", 'id' => $uso_institucional->id],201);

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }
    public function crear_libros_faltantes(Request $request){
        /*(1)*/
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
                /*(2)*/
                if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){
                    /*(3)*/
                    $respuesta=$this->validarFechasSucursal(request('id_plan_trabajo'),request('fecha_inicio'),request('fecha_fin'), 'libros_faltantes');                
                

            if($respuesta>0){
                    /*(4)*/
                    $libro_faltantes =LibrosFaltantes::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>request('id_prioridad'),
                        'id_estado' =>1,

                    ]);
            }else{
                return response()->json(['Las fechas se encuentra en el rango de fechas de otra actividad igual en Libro de faltantes'],400);

            }

                    return response()->json(["success"=>"Actividad creada", 'id' => $libro_faltantes->id],201);

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }
    public function crear_compromisos(Request $request){
        /*(1)*/
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
                /*(2)*/
                if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){
                    /*(3)*/
                    $respuesta=$this->validarFechasSucursal(request('id_plan_trabajo'),request('fecha_inicio'),request('fecha_fin'), 'compromisos');                
                   


            if($respuesta>0){
                    /*(4)*/
                    $compromisos =Compromiso::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>request('id_prioridad'),
                        'id_estado' =>1,

                    ]);
            }else{
                return response()->json(['Las fechas se encuentra en el rango de fechas de otra actividad igual en Compromiso'],400);

            }

                    return response()->json(["success"=>"Actividad creada", 'id' => $compromisos->id],201);

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }
    public function crear_senalizacion(Request $request){
        /*(1)*/
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
                /*(2)*/
                if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){
                    /*(3)*/
                    $respuesta=$this->validarFechasSucursal(request('id_plan_trabajo'),request('fecha_inicio'),request('fecha_fin'), 'senalizacion');                
                   


            if($respuesta>0){
                    /*(4)*/
                    $senalizacion =Senalizacion::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>request('id_prioridad'),
                        'id_estado' =>1,

                    ]);
            }else{
                return response()->json(['Las fechas se encuentra en el rango de fechas de otra actividad igual en Seneñalizacion'],400);

            }

                    return response()->json(["success"=>"Actividad creada", 'id' => $senalizacion->id],201);

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }
    public function crear_contratos_anexos_legalizacion(Request $request){
        /*(1)*/
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
                /*(2)*/
                if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){
                    /*(3)*/
                    $respuesta=$this->validarFechasSucursal(request('id_plan_trabajo'),request('fecha_inicio'),request('fecha_fin'), 'contratos_anexos_legalizacion');                
                   


            if($respuesta>0){
                    /*(4)*/
                    $contrato =ContratoAnexosLegalizacion::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>request('id_prioridad'),
                        'id_estado' =>1,

                    ]);
            }else{
                return response()->json(['Las fechas se encuentra en el rango de fechas de otra actividad igual en Contrato y anexos para la legaliación'],400);

            }

                    return response()->json(["success"=>"Actividad creada", 'id' => $contrato->id],201);

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }
    public function crear_solicitud_seguro(Request $request){
        /*(1)*/
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
                /*(2)*/
                if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){
                    /*(3)*/
                    $respuesta=$this->validarFechasSucursal(request('id_plan_trabajo'),request('fecha_inicio'),request('fecha_fin'), 'solicitud_seguro');                
                   


            if($respuesta>0){
                    /*(4)*/
                    $seguro =SolicitudSeguro::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>request('fecha_inicio'),
                        'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                        'observacion'=>'',
                        'id_prioridad' =>request('id_prioridad'),
                        'id_estado' =>1,

                    ]);
            }else{
                return response()->json(['Las fechas se encuentra en el rango de fechas de otra actividad igual en Solicitud de seguro de punto de venta'],400);

            }

                    return response()->json(["success"=>"Actividad creada", 'id' => $seguro->id],201);

                }else{
                    return response()->json(["La fecha inicial debe ser mayor o igual a la fecha actual y menor o igual a la fecha final"],400);

                }
            }
    }
    public function crear_ptc(Request $request){

        //imporante el id del plana de trabajo debe estar creado a la hora de crear las actividades a dicho plan de trabajo
        /*(1)*/
        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required|numeric',
            'titulo' => 'required',
            'descripcion_ptc' => 'required',
            'data' => 'required',
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
                $ptc =ActividadPtc::create([

                    'id_plan_trabajo' =>request('id_plan_trabajo'),
                    'titulo' =>request('titulo'),
                    'fecha_inicio' =>request('fecha_inicio'),
                    'fecha_fin' =>request('fecha_fin').' '.'23:59:00',
                    'observacion'=>'',
                    'id_prioridad' =>request('id_prioridad'),
                    'descripcion_ptc' =>request('descripcion_ptc'),
                    'data' =>request('data'),
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
