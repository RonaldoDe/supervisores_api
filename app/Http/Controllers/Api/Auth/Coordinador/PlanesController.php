<?php

namespace App\Http\Controllers\Api\Auth\Coordinador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Modelos\PlanTrabajoAsignacion;

class PlanesController extends Controller
{
    public function listarActividades(Request $request)
    {
        $validator=\Validator::make($request->all(),[
            'id_plan_trabajo' => 'required',

        ]);

        if($validator->fails())
        {
          return response()->json( $errors=$validator->errors()->all(),400 );
        }

        else
        {
            $user=DB::table('users as u')->where('u.id','=',Auth::id())->first();
            $coordinador=DB::table('coordinadores')->where('cedula',$user->cedula)->first();

            if($coordinador != null){
                //obtener las actividades segun su plan de trabajo 
                $actividades=DB::table('plan_trabajo_asignacion as p')
                ->select('su.nombre as nombreSucursal', 'p.nombre as nombrePlan', 'ac.nombre_tabla', 'p.id_plan_trabajo', 'ac.nombre_actividad')
                ->join('actividades as ac','p.id_plan_trabajo','ac.id_plan_trabajo')
                ->join('sucursales as su','p.id_sucursal','su.id_suscursal')
                ->where('p.id_plan_trabajo',request('id_plan_trabajo'))
                ->where('p.idcoordinador',$coordinador->id_cordinador)
                ->orderby('ac.id_plan_trabajo','desc')
                ->get();

                $plan = DB::table('plan_trabajo_asignacion as p')
                ->where('p.id_plan_trabajo', request('id_plan_trabajo'))
                ->first();
    
                //array que almacenará las actividanes correspondientes a los 7 dias despues del dia actual 
                $lista_actividades_arr = array();
                //bucle que itera las actividades y las obtiene segun el plan de trabajo
                foreach($actividades as $ac){
                    $fe = DB::table($ac->nombre_tabla. ' as ac')
                    ->select('ac.fecha_inicio', 'ac.fecha_fin', 'ac.id_plan_trabajo', 'ac.id', 'ac.id_prioridad', 'ac.estado')
                    ->where('ac.id_plan_trabajo',$ac->id_plan_trabajo)
                    ->where('ac.estado', '!=','completo')
                    ->get();
    
                    //  generar el array con el listado de actividades pendientes en la semana
                    foreach($fe as $fecha){
                        $fecha->nombre_actividad = $ac->nombre_actividad;
                        array_push($lista_actividades_arr, [$ac->nombreSucursal =>$fecha]);
                    }
                    
                    
                }
                    // validar si el array tiene actividades
                    return response()->json(['Actividades' => $lista_actividades_arr, 'Nombre' => $plan->nombre, 'Sucursal' => $plan->id_sucursal],200);
                
            }else{
                return response()->json('No tienes permiso para acceder a esta ruta',400);
            }
            
        }
    }

    public function allActividades(Request $request)
    {
        $validator=\Validator::make($request->all(),[
            'id_plan_trabajo' => 'required',
        ]);

        if($validator->fails())
        {
          return response()->json( $errors=$validator->errors()->all(),400 );
        }

        else
        {
            $user=DB::table('users as u')->where('u.id','=',Auth::id())->first();
            $coordinador=DB::table('coordinadores')->where('cedula',$user->cedula)->first();

            if($coordinador != null){
                //obtener las actividades segun su plan de trabajo 
                $actividades=DB::table('plan_trabajo_asignacion as p')
                ->select('su.nombre as nombreSucursal', 'p.nombre as nombrePlan', 'ac.nombre_tabla', 'p.id_plan_trabajo', 'ac.nombre_actividad')
                ->join('actividades as ac','p.id_plan_trabajo','ac.id_plan_trabajo')
                ->join('sucursales as su','p.id_sucursal','su.id_suscursal')
                ->where('p.id_plan_trabajo',request('id_plan_trabajo'))
                ->where('p.idcoordinador',$coordinador->id_cordinador)
                ->orderby('ac.id_plan_trabajo','desc')
                ->get();

                $plan = DB::table('plan_trabajo_asignacion as p')
                ->where('p.id_plan_trabajo', request('id_plan_trabajo'))
                ->first();
    
                if(count($actividades) > 0){
                    //array que almacenará las actividanes correspondientes a los 7 dias despues del dia actual 
                    $lista_actividades_arr = array();
                    //bucle que itera las actividades y las obtiene segun el plan de trabajo
                    foreach($actividades as $ac){
                        $fe = DB::table($ac->nombre_tabla. ' as ac')
                        ->where('ac.id_plan_trabajo',$ac->id_plan_trabajo)
                        ->get();
        
                        //  generar el array con el listado de actividades pendientes en la semana
                        foreach($fe as $fecha){
                            $fecha->nombre_actividad = $ac->nombre_actividad;
                            array_push($lista_actividades_arr, $fecha);
                        }
                        
                        
                    }
                    return response()->json(['Actividades' => $lista_actividades_arr, 'Nombre' => $plan->nombre, 'id_sucursal' => $plan->id_sucursal, 'sucursal' => $ac->nombreSucursal],200);
                }else{
                    return response()->json(['Actividades' => [], 'Nombre' => $plan->nombre, 'id_sucursal' => $plan->id_sucursal, 'sucursal' => $ac->nombreSucursal],200);
                }
                
            }else{
                return response()->json('No tienes permiso para acceder a esta ruta',400);
            }
            
        }
    }

    public function deletePlan(Request $request)
    {
        $validator=\Validator::make($request->all(),[
            'id_plan_trabajo' => 'required',
        ]);

        if($validator->fails())
        {
          return response()->json( $errors=$validator->errors()->all(),400 );
        }

        else
        {
            $user=DB::table('users as u')->where('u.id','=',Auth::id())->first();
            $coordinador=DB::table('coordinadores')->where('cedula',$user->cedula)->first();

            if($coordinador != null){
                //obtener las actividades segun su plan de trabajo 
                $plan_coordinador=DB::table('plan_trabajo_asignacion as p')
                ->where('p.id_plan_trabajo',request('id_plan_trabajo'))
                ->where('p.idcoordinador',$coordinador->id_cordinador)
                ->first();

                if($plan_coordinador != null){
                    $plan = DB::table('actividades')
                    ->where('id_plan_trabajo', request('id_plan_trabajo'))
                    ->get();
                    if(count($plan) > 0){
                        return response()->json('Este plan tiene actividades, no se puede borrar',400);
                    }else{
                        $delete_plan = DB::table('plan_trabajo_asignacion')
                        ->where('id_plan_trabajo', request('id_plan_trabajo'))
                        ->delete();
                        if($delete_plan){
                            return response()->json('Plan eliminado con exito',200);
                        }else{
                            return response()->json('Error del servido o plan inexistente',400);
                        }
                    }
                }else{
                    return response()->json('No tienes permiso para acceder a este plan o el plan no existe',400);
                }
                
            }else{
                return response()->json('No tienes permiso para acceder a esta ruta',400);
            }
            
        }
    }

    public function asignarEstadoPlan(Request $request)
    {
        $validator=\Validator::make($request->all(),[
            'id_plan_trabajo' => 'required',
        ]);

        if($validator->fails())
        {
          return response()->json( $errors=$validator->errors()->all(),400 );
        }

        else
        {
        $user=DB::table('users as u')->where('u.id','=',Auth::id())->first();
            $coordinador=DB::table('coordinadores')->where('cedula',$user->cedula)->first();

            if($coordinador != null){
                //obtener permiso para el coordinador
                $plan_coordinador=DB::table('plan_trabajo_asignacion as p')
                ->where('p.id_plan_trabajo',request('id_plan_trabajo'))
                ->where('p.idcoordinador',$coordinador->id_cordinador)
                ->first();

                if($plan_coordinador != null){
                    $plan = PlanTrabajoAsignacion::where('id_plan_trabajo', request('id_plan_trabajo'))->first();
                    if($plan!= null){
                        if($plan->estado == 1){
                            $plan->estado = 0;
                            $plan->update();
                            return response()->json('Plan desasignado con exito.',200);
                        }else if($plan->estado == 0) {
                            $plan->estado = 1;
                            $plan->update();
                            return response()->json('Plan asignado con exito.',200);
                        }else{
                            return response()->json('Este plan de trabajo ya esta completo.',400);
                        }
                    }
                }else{
                    return response()->json('No tienes permiso para acceder a este plan o el plan no existe',400);
                }
            }
        }
    }
    
}
