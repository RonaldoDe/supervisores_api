<?php

namespace App\Http\Controllers;

use Storage;

use Illuminate\Http\Request;
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

class ValidarActividadesController extends Controller
{
    //requerimiento de datos para llenar la actividad
    public function apertura($request)
    {
        //validacion de los datos de la actividad
        $validator=\Validator::make($request->all(),[
            'id_actividad' => 'required',
            'id_plan_trabajo' => 'required',
            'nombre_tabla' => 'required',
            'calificacion_pv' => 'required',
            'tiempo_actividad'=>'required',
            'tiempo_total'=>'required',

        ]);
        if($validator->fails())
        {
          return response()->json( ['message' => $validator->errors()->all()],400 );
        }

        else
        {
            //actualizacion de la actividad por el supervisor
            $actividad = Apertura::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
            if($actividad!= null){
                $actividad->fecha_mod =  date('Y-m-d H:i:s');
                $actividad->observacion = request('observaciones');
                $actividad->estado = 'completo';
                $actividad->calificacion = 5;
                $actividad->calificacion_pv = request('calificacion_pv');
                $actividad->tiempo_actividad = request('tiempo_actividad');
                $actividad->tiempo_total = request('tiempo_total');
                $actividad->motivo_ausencia = request('motivo_ausencia');
                $actividad->calificacion_pv = request('calificacion_pv');
                $actividad->update();

                //registro de notificacion
                if($actividad){
                    $nombre_plan = DB::table('plan_trabajo_asignacion')
                    ->select('nombre')
                    ->where('id_plan_trabajo', request('id_plan_trabajo'))
                    ->first();

                    $nombre_actividad = DB::table('actividades')
                    ->select('nombre_actividad')
                    ->where('nombre_tabla',request('nombre_tabla'))
                    ->where('id_plan_trabajo',request('id_plan_trabajo'))
                    ->first();

                    //Se recupera los datos del usuario que se ha autenticado
                    $user=DB::table('users as u')->where('u.id','=',Auth::id())->first();

                    if($user != null){
                        //obtener los datos del usuario supervisor
                        $nombre_supervisor=DB::table('usuario as u')
                        ->select('u.id_usuario', 'u.nombre')
                        ->where('u.correo','=',$user->email)->first();

                        $notificacion =Notificaciones::create([
                            'id_plan_trabajo' =>request('id_plan_trabajo'),
                            'nombre_plan' =>$nombre_plan->nombre,
                            'nombre_actividad' =>$nombre_actividad->nombre_actividad,
                            'nombre_supervisor' => $nombre_supervisor->nombre,
                            'fecha' => date('Y-m-d H:i:s'),
        
                        ]);
                    }

                    return response()->json(['message' => 'Actividad realizada con exito']);
                }
            }
            return response()->json(['message' => 'Error Actividad no encontrada']);
        }
    }

     //requerimiento de datos para la actividad
     public function condiciones_locativas($request)
     {
         //validacion de los datos de la actividad
         $validator=\Validator::make($request->all(),[
             'id_actividad' => 'required',
            'nombre_tabla' => 'required',
            'id_plan_trabajo' => 'required',
            'calificacion_pv' => 'required',
            'tiempo_actividad'=>'required',
            'tiempo_total'=>'required',

         ]);
         if($validator->fails())
         {
           return response()->json( ['message' => $validator->errors()->all()],400 );
         }

         else
         {

             //actualizacion de la actividad por el supervisor
             $actividad = CondicionesLocativas::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
             if($actividad!= null){
                 $actividad->fecha_mod = date('Y-m-d H:i:s');
                 $actividad->observacion = request('observaciones');
                 $actividad->estado = 'completo';
                 $actividad->calificacion = 5;
                 $actividad->calificacion_pv = request('calificacion_pv');
                 $actividad->tiempo_actividad = request('tiempo_actividad');
                $actividad->tiempo_total = request('tiempo_total');
                $actividad->motivo_ausencia = request('motivo_ausencia');
                $actividad->update();
                 return response()->json(['message' => 'Actividad realizada con exito']);
             }
             return response()->json(['message' => 'Error Actividad no encontrada']);
         }
     }

     //requerimiento de datos para la actividad
     public function formulas_despachos($request)
     {
         //validacion de los datos de la actividad
         $validator=\Validator::make($request->all(),[
            'id_actividad' => 'required',
            'nombre_tabla' => 'required',
            'id_plan_trabajo' => 'required',
            'calificacion_pv' => 'required',
            'tiempo_actividad'=>'required',
            'tiempo_total'=>'required',

         ]);
         if($validator->fails())
         {
           return response()->json( ['message' => $validator->errors()->all()],400 );
         }

         else
         {

             //actualizacion de la actividad por el supervisor
             $actividad = FormulasDespachos::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
             if($actividad!= null){
                 $actividad->fecha_mod = date('Y-m-d H:i:s');
                 $actividad->observacion = request('observaciones');
                 $actividad->estado = 'completo';
                 $actividad->calificacion = 5;
                 $actividad->calificacion_pv = request('calificacion_pv');
                 $actividad->tiempo_actividad = request('tiempo_actividad');
                $actividad->tiempo_total = request('tiempo_total');
                $actividad->motivo_ausencia = request('motivo_ausencia');
                $actividad->update();
                 return response()->json(['message' => 'Actividad realizada con exito']);
             }
             return response()->json(['message' => 'Error Actividad no encontrada']);
         }
     }

     //requerimiento de datos para la actividad
     public function kardex($request)
     {
         //validacion de los datos de la actividad
         $validator=\Validator::make($request->all(),[
            'id_actividad' => 'required',
            'nombre_tabla' => 'required',
            'id_plan_trabajo' => 'required',
            'calificacion_pv' => 'required',
            'tiempo_actividad'=>'required',
            'tiempo_total'=>'required',

         ]);
         if($validator->fails())
         {
           return response()->json( ['message' => $validator->errors()->all()],400 );
         }

         else
         {

             //actualizacion de la actividad por el supervisor
             $actividad = Kardex::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
             if($actividad!= null){
                 $actividad->fecha_mod = date('Y-m-d H:i:s');
                 $actividad->observacion = request('observaciones');
                 $actividad->estado = 'completo';
                 $actividad->calificacion = 5;
                 $actividad->calificacion_pv = request('calificacion_pv');
                 $actividad->tiempo_actividad = request('tiempo_actividad');
                $actividad->tiempo_total = request('tiempo_total');
                $actividad->motivo_ausencia = request('motivo_ausencia');
                $actividad->update();
                 return response()->json(['message' => 'Actividad realizada con exito']);
             }
             return response()->json(['message' => 'Error Actividad no encontrada']);
         }
     }

     //requerimiento de datos para la actividad
     public function papeleria_consignaciones($request)
     {
         //validacion de los datos de la actividad
         $validator=\Validator::make($request->all(),[
             'id_actividad' => 'required',
             'papeleria' => 'required',
             'valor_consignacion' => 'required',
             'valor_faltante' => 'required',
             'valor_sobrante' => 'required',
             'calificacion_pv' => 'required',
             'tiempo_actividad'=>'required',
             'tiempo_total'=>'required',

         ]);
         if($validator->fails())
         {
           return response()->json( ['message' => $validator->errors()->all()],400 );
         }

         else
         {

             //actualizacion de la actividad por el supervisor
             $actividad = PapeleriaConsignaciones::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
             if($actividad!= null){
                 $actividad->fecha_mod = date('Y-m-d H:i:s');
                 $actividad->observacion = request('observaciones');
                 $actividad->papeleria = request('papeleria');
                 $actividad->valor_consignacion = request('valor_consignacion');
                 $actividad->valor_faltante = request('valor_faltante');
                 $actividad->valor_sobrante = request('valor_sobrante');
                 $actividad->estado = 'completo';
                 $actividad->calificacion = 5;
                 $actividad->calificacion_pv = request('calificacion_pv');
                 $actividad->tiempo_actividad = request('tiempo_actividad');
                $actividad->tiempo_total = request('tiempo_total');
                $actividad->motivo_ausencia = request('motivo_ausencia');
                $actividad->update();
                 return response()->json(['message' => 'Actividad realizada con exito']);
             }
             return response()->json(['message' => 'Error Actividad no encontrada']);
         }
     }

     //requerimiento de datos para la actividad
     public function remisiones($request)
     {
         //validacion de los datos de la actividad
         $validator=\Validator::make($request->all(),[
             'id_actividad' => 'required',
             'calificacion_pv' => 'required',
             'tiempo_actividad'=>'required',
            'tiempo_total'=>'required',

         ]);
         if($validator->fails())
         {
           return response()->json( ['message' => $validator->errors()->all()],400 );
         }

         else
         {

             //actualizacion de la actividad por el supervisor
             $actividad = Remisiones::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
             if($actividad!= null){
                 $actividad->fecha_mod = date('Y-m-d H:i:s');
                 $actividad->observacion = request('observaciones');
                 $actividad->estado = 'completo';
                 $actividad->calificacion = 5;
                 $actividad->calificacion_pv = request('calificacion_pv');
                 $actividad->tiempo_actividad = request('tiempo_actividad');
                $actividad->tiempo_total = request('tiempo_total');
                $actividad->motivo_ausencia = request('motivo_ausencia');
                $actividad->update();
                 return response()->json(['message' => 'Actividad realizada con exito']);
             }
             return response()->json(['message' => 'Error Actividad no encontrada']);
         }
     }

     //requerimiento de datos para la actividad
     public function captura_cliente($request)
     {
         //validacion de los datos de la actividad
         $validator=\Validator::make($request->all(),[
             'id_actividad' => 'required',
             'calificacion_pv' => 'required',
             'tiempo_actividad'=>'required',
            'tiempo_total'=>'required',

         ]);
         if($validator->fails())
         {
           return response()->json( ['message' => $validator->errors()->all()],400 );
         }

         else
         {

             //actualizacion de la actividad por el supervisor
             $actividad = CapturaClientes::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
             if($actividad!= null){
                 $actividad->fecha_mod = date('Y-m-d H:i:s');
                 $actividad->observacion = request('observaciones');
                 $actividad->estado = 'completo';
                 $actividad->calificacion = 5;
                 $actividad->calificacion_pv = request('calificacion_pv');
                 $actividad->tiempo_actividad = request('tiempo_actividad');
                $actividad->tiempo_total = request('tiempo_total');
                $actividad->motivo_ausencia = request('motivo_ausencia');
                $actividad->update();
                 return response()->json(['message' => 'Actividad realizada con exito']);
             }
             return response()->json(['message' => 'Error Actividad no encontrada']);
         }
     }

     public function convenio_exhibicion($request)
     {
         //validacion de los datos de la actividad
         $validator=\Validator::make($request->all(),[
             'id_actividad' => 'required',
             'calificacion_pv' => 'required',
             'tiempo_actividad'=>'required',
            'tiempo_total'=>'required',

         ]);
         if($validator->fails())
         {
           return response()->json( ['message' => $validator->errors()->all()],400 );
         }

         else
         {

             //actualizacion de la actividad por el supervisor
             $actividad = ConvenioExhibicion::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
             if($actividad!= null){
                 $actividad->fecha_mod = date('Y-m-d H:i:s');
                 $actividad->observacion = request('observaciones');
                 $actividad->estado = 'completo';
                 $actividad->calificacion = 5;
                 $actividad->calificacion_pv = request('calificacion_pv');
                 $actividad->tiempo_actividad = request('tiempo_actividad');
                $actividad->tiempo_total = request('tiempo_total');
                $actividad->motivo_ausencia = request('motivo_ausencia');
                $actividad->update();
                 return response()->json(['message' => 'Actividad realizada con exito']);
             }
             return response()->json(['message' => 'Error Actividad no encontrada']);
         }
     }

     public function evaluacion_pedidos($request)
     {
         //validacion de los datos de la actividad
         $validator=\Validator::make($request->all(),[
             'id_actividad' => 'required',
             'calificacion_pv' => 'required',
             'num_remision' => 'required',
             'tiempo_actividad'=>'required',
            'tiempo_total'=>'required',

         ]);
         if($validator->fails())
         {
           return response()->json( ['message' => $validator->errors()->all()],400 );
         }

         else
         {

             //actualizacion de la actividad por el supervisor
             $actividad = EvaluacionPedidos::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
             if($actividad!= null){
                 $actividad->fecha_mod = date('Y-m-d H:i:s');
                 $actividad->num_remision = request('num_remision');
                 $actividad->observacion = request('observaciones');
                 $actividad->estado = 'completo';
                 $actividad->calificacion = 5;
                 $actividad->calificacion_pv = request('calificacion_pv');
                 $actividad->tiempo_actividad = request('tiempo_actividad');
                $actividad->tiempo_total = request('tiempo_total');
                $actividad->motivo_ausencia = request('motivo_ausencia');
                $actividad->update();
                 return response()->json(['message' => 'Actividad realizada con exito']);
             }
             return response()->json(['message' => 'Error Actividad no encontrada']);
         }
     }

     public function excesos($request)
     {
         //validacion de los datos de la actividad
         $validator=\Validator::make($request->all(),[
             'id_actividad' => 'required',
             'calificacion_pv' => 'required',
             'tiempo_actividad'=>'required',
            'tiempo_total'=>'required',

         ]);
         if($validator->fails())
         {
           return response()->json( ['message' => $validator->errors()->all()],400 );
         }

         else
         {

             //actualizacion de la actividad por el supervisor
             $actividad = Excesos::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
             if($actividad!= null){
                 $actividad->fecha_mod = date('Y-m-d H:i:s');
                 $actividad->observacion = request('observaciones');
                 $actividad->estado = 'completo';
                 $actividad->calificacion = 5;
                 $actividad->calificacion_pv = request('calificacion_pv');
                 $actividad->tiempo_actividad = request('tiempo_actividad');
                $actividad->tiempo_total = request('tiempo_total');
                $actividad->motivo_ausencia = request('motivo_ausencia');
                $actividad->update();
                 return response()->json(['message' => 'Actividad realizada con exito']);
             }
             return response()->json(['message' => 'Error Actividad no encontrada']);
         }
     }

     public function ingreso_sucursal($request)
     {
         //validacion de los datos de la actividad
         $validator=\Validator::make($request->all(),[
             'id_actividad' => 'required',
             'calificacion_pv' => 'required',
             'tiempo_actividad'=>'required',
            'tiempo_total'=>'required',

         ]);
         if($validator->fails())
         {
           return response()->json( ['message' => $validator->errors()->all()],400 );
         }

         else
         {

             //actualizacion de la actividad por el supervisor
             $actividad = IngresoSucursal::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
             if($actividad!= null){
                 $actividad->fecha_mod = date('Y-m-d H:i:s');
                 $actividad->observacion = request('observaciones');
                 $actividad->estado = 'completo';
                 $actividad->calificacion = 5;
                 $actividad->calificacion_pv = request('calificacion_pv');
                 $actividad->tiempo_actividad = request('tiempo_actividad');
                $actividad->tiempo_total = request('tiempo_total');
                $actividad->motivo_ausencia = request('motivo_ausencia');
                $actividad->update();
                 return response()->json(['message' => 'Actividad realizada con exito']);
             }
             return response()->json(['message' => 'Error Actividad no encontrada']);
         }
     }

     public function libro_agendaclientes($request)
     {
         //validacion de los datos de la actividad
         $validator=\Validator::make($request->all(),[
             'id_actividad' => 'required',
             'calificacion_pv' => 'required',
             'tiempo_actividad'=>'required',
            'tiempo_total'=>'required',

         ]);
         if($validator->fails())
         {
           return response()->json( ['message' => $validator->errors()->all()],400 );
         }

         else
         {

             //actualizacion de la actividad por el supervisor
             $actividad = LibroAgendasCliente::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
             if($actividad!= null){
                 $actividad->fecha_mod = date('Y-m-d H:i:s');
                 $actividad->observacion = request('observaciones');
                 $actividad->estado = 'completo';
                 $actividad->calificacion = 5;
                 $actividad->calificacion_pv = request('calificacion_pv');
                 $actividad->tiempo_actividad = request('tiempo_actividad');
                $actividad->tiempo_total = request('tiempo_total');
                $actividad->motivo_ausencia = request('motivo_ausencia');
                $actividad->update();
                 return response()->json(['message' => 'Actividad realizada con exito']);
             }
             return response()->json(['message' => 'Error Actividad no encontrada']);
         }
     }

     public function libros_faltantes($request)
     {
         //validacion de los datos de la actividad
         $validator=\Validator::make($request->all(),[
             'id_actividad' => 'required',
             'calificacion_pv' => 'required',
             'tiempo_actividad'=>'required',
            'tiempo_total'=>'required',

         ]);
         if($validator->fails())
         {
           return response()->json( ['message' => $validator->errors()->all()],400 );
         }

         else
         {

             //actualizacion de la actividad por el supervisor
             $actividad = LibrosFaltantes::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
             if($actividad!= null){
                 $actividad->fecha_mod = date('Y-m-d H:i:s');
                 $actividad->observacion = request('observaciones');
                 $actividad->estado = 'completo';
                 $actividad->calificacion = 5;
                 $actividad->calificacion_pv = request('calificacion_pv');
                 $actividad->tiempo_actividad = request('tiempo_actividad');
                $actividad->tiempo_total = request('tiempo_total');
                $actividad->motivo_ausencia = request('motivo_ausencia');
                $actividad->update();
                 return response()->json(['message' => 'Actividad realizada con exito']);
             }
             return response()->json(['message' => 'Error Actividad no encontrada']);
         }
     }

     public function libro_vencimientos($request)
     {
         //validacion de los datos de la actividad
         $validator=\Validator::make($request->all(),[
             'id_actividad' => 'required',
             'calificacion_pv' => 'required',
             'tiempo_actividad'=>'required',
            'tiempo_total'=>'required',

         ]);
         if($validator->fails())
         {
           return response()->json( ['message' => $validator->errors()->all()],400 );
         }

         else
         {

             //actualizacion de la actividad por el supervisor
             $actividad = LibroVencimientos::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
             if($actividad!= null){
                 $actividad->fecha_mod = date('Y-m-d H:i:s');
                 $actividad->observacion = request('observaciones');
                 $actividad->estado = 'completo';
                 $actividad->calificacion = 5;
                 $actividad->calificacion_pv = request('calificacion_pv');
                 $actividad->tiempo_actividad = request('tiempo_actividad');
                $actividad->tiempo_total = request('tiempo_total');
                $actividad->motivo_ausencia = request('motivo_ausencia');
                $actividad->update();
                 return response()->json(['message' => 'Actividad realizada con exito']);
             }
             return response()->json(['message' => 'Error Actividad no encontrada']);
         }
     }

     public function presupuesto_pedido($request)
     {
         //validacion de los datos de la actividad
         $validator=\Validator::make($request->all(),[
             'id_actividad' => 'required',
             'calificacion_pv' => 'required',
             'tiempo_actividad'=>'required',
            'tiempo_total'=>'required',

         ]);
         if($validator->fails())
         {
           return response()->json( ['message' => $validator->errors()->all()],400 );
         }

         else
         {

             //actualizacion de la actividad por el supervisor
             $actividad = PresupuestoPedidos::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
             if($actividad!= null){
                 $actividad->fecha_mod = date('Y-m-d H:i:s');
                 $actividad->observacion = request('observaciones');
                 $actividad->estado = 'completo';
                 $actividad->calificacion = 5;
                 $actividad->calificacion_pv = request('calificacion_pv');
                 $actividad->tiempo_actividad = request('tiempo_actividad');
                $actividad->tiempo_total = request('tiempo_total');
                $actividad->motivo_ausencia = request('motivo_ausencia');
                $actividad->update();
                 return response()->json(['message' => 'Actividad realizada con exito']);
             }
             return response()->json(['message' => 'Error Actividad no encontrada']);
         }
     }

     public function revision_completa_inventarios($request)
     {
         //validacion de los datos de la actividad
         $validator=\Validator::make($request->all(),[
             'id_actividad' => 'required',
             'calificacion_pv' => 'required',
             'tiempo_actividad'=>'required',
            'tiempo_total'=>'required',

         ]);
         if($validator->fails())
         {
           return response()->json( ['message' => $validator->errors()->all()],400 );
         }

         else
         {

             //actualizacion de la actividad por el supervisor
             $actividad = RevisionCompletaInventarios::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
             if($actividad!= null){
                 $actividad->fecha_mod = date('Y-m-d H:i:s');
                 $actividad->observacion = request('observaciones');
                 $actividad->estado = 'completo';
                 $actividad->calificacion = 5;
                 $actividad->calificacion_pv = request('calificacion_pv');
                 $actividad->tiempo_actividad = request('tiempo_actividad');
                $actividad->tiempo_total = request('tiempo_total');
                $actividad->motivo_ausencia = request('motivo_ausencia');
                $actividad->update();
                 return response()->json(['message' => 'Actividad realizada con exito']);
             }
             return response()->json(['message' => 'Error Actividad no encontrada']);
         }
     }

     public function seguimiento_vendedores($request)
     {
         //validacion de los datos de la actividad
         $validator=\Validator::make($request->all(),[
             'id_actividad' => 'required',
             'calificacion_pv' => 'required',
             'tiempo_actividad'=>'required',
            'tiempo_total'=>'required',

         ]);
         if($validator->fails())
         {
           return response()->json( ['message' => $validator->errors()->all()],400 );
         }

         else
         {

             //actualizacion de la actividad por el supervisor
             $actividad = SeguimientoVendedor::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
             if($actividad!= null){
                 $actividad->fecha_mod = date('Y-m-d H:i:s');
                 $actividad->observacion = request('observaciones');
                 $actividad->estado = 'completo';
                 $actividad->calificacion = 5;
                 $actividad->calificacion_pv = request('calificacion_pv');
                 $actividad->tiempo_actividad = request('tiempo_actividad');
                $actividad->tiempo_total = request('tiempo_total');
                $actividad->motivo_ausencia = request('motivo_ausencia');
                $actividad->update();
                 return response()->json(['message' => 'Actividad realizada con exito']);
             }
             return response()->json(['message' => 'Error Actividad no encontrada']);
         }
     }

     public function documentacion_legal($request)
     {
         //validacion de los datos de la actividad
         $validator=\Validator::make($request->all(),[
             'id_actividad' => 'required',
             'calificacion_pv' => 'required',
             'tiempo_actividad'=>'required',
            'tiempo_total'=>'required',

         ]);
         if($validator->fails())
         {
           return response()->json( ['message' => $validator->errors()->all()],400);
         }

         else
         {

             //actualizacion de la actividad por el supervisor
             $actividad = DocumentacionLegal::where('id_plan_trabajo', request('id_plan_trabajo'))->find(request('id_actividad'));
             if($actividad!= null){
                 $img_vencido = 'documento_vencido' . time();
                 $img_renovado = 'documento_renovado' . time();
                 

                 if (request('documento_vencido') != "" && request('documento_renovado') != "") { // storing image in storage/app/public Folder
                    if(strpos(request('documento_vencido'), 'supervisores_api/storage/app/public/img') == false ){
                        Storage::disk('public')->put('img/'.$img_vencido, base64_decode(request('documento_vencido')));
                        $actividad->documento_vencido = $img_vencido;
                    }

                    if(strpos(request('documento_renovado'), 'supervisores_api/storage/app/public/img') == false ){
                        Storage::disk('public')->put('img/'.$img_renovado, base64_decode(request('documento_renovado')));
                        $actividad->documento_renovado = $img_renovado;
                    }
                }
                 $actividad->fecha_mod = date('Y-m-d H:i:s');
                 $actividad->observacion = request('observaciones');
                 $actividad->estado = 'completo';
                 $actividad->calificacion = 5;
                 $actividad->calificacion_pv = request('calificacion_pv');
                 $actividad->tiempo_actividad = request('tiempo_actividad');
                 $actividad->tiempo_total = request('tiempo_total');
                $actividad->motivo_ausencia = request('motivo_ausencia');
                $actividad->update();
                 return response()->json(['message' => 'Actividad realizada con exito']);
             }
             return response()->json(['message' => 'Error Actividad no encontrada']);
         }
     }
}
