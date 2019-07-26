<?php

namespace App\Http\Controllers\Api\Auth\Administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ActividadesController extends Controller
{
    public function mostrarActividadesPorPlan(Request $request)
    {

        $validator=\Validator::make($request->all(),[
            'id_plan_trabajo'=>'required|numeric'
        ]);
        if($validator->fails())
        {
          return response()->json( $errors=$validator->errors()->all() );
        }

        else
        {
            $actividades = DB::table('actividades as ac')
            ->where('ac.id_plan_trabajo',request('id_plan_trabajo'))
            ->get();
            //array para guardar los datos de lasactividades
            $actividades_arr = array();
            foreach($actividades as $ac){
                $activities = DB::table($ac->nombre_tabla.' as ac')
                ->where('ac.id_plan_trabajo',request('id_plan_trabajo'))
                ->get();
                array_push($actividades_arr, [$ac->nombre_actividad => $activities]);
            }
            if(count($actividades_arr) > 0){
                return response()->json($actividades_arr, 201);
            }else{
                return response()->json(["message" => 'No tienes actividades asignadas'],200);
            }
        }
    }

    public function mostrarReporteAdmin(){

        $plan_trabajo = DB::table('plan_trabajo_asignacion as pt')
        ->get();

        //array de las sucursales
        $sucursales_arr = array();
        foreach($plan_trabajo as $plan){
            $sucursales = DB::table('sucursales as su')
            ->select('su.cod_sucursal', 'su.nombre as nombre_sucursal', 'zo.descripcion_zona', 'us.nombre as nombre_supervisor', 'us.apellido','us.cedula')
            ->join('zona as zo','su.id_zona','zo.id_zona')
            ->join('usuario_zona as uz','zo.id_zona','uz.id_zona')
            ->join('usuarios_roles as ur','uz.id_usuario','ur.id_usuario_roles')
            ->join('usuario as us','ur.id_usuario','us.id_usuario')
            ->where('su.id_suscursal',$plan->id_sucursal)
            ->where('ur.id_usuario_roles',$plan->id_supervisor)
            ->get();
            foreach($sucursales as $sucursal){
                $sucursal->id_plan_trabajo = $plan->id_plan_trabajo;
                $cordinador=DB::table('coordinadores')
                ->where('id_cordinador',$plan->idcoordinador)
                ->first();
                array_push($sucursales_arr, [$cordinador->nombre => [$sucursal->nombre_sucursal => $sucursales]]);
            }
        }

        return response()->json($sucursales_arr, 201);
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
            //obtener el usuario y el usuario coordinador respectivamente
            $user=DB::table('users as u')->where('u.id','=',Auth::id())->first();

                $actividades=DB::table('plan_trabajo_asignacion as p')
                ->select('su.nombre as nombreSucursal', 'p.nombre as nombrePlan', 'ac.nombre_tabla', 'p.id_plan_trabajo', 'ac.nombre_actividad')
                ->join('actividades as ac','p.id_plan_trabajo','ac.id_plan_trabajo')
                ->join('sucursales as su','p.id_sucursal','su.id_suscursal')
                ->where('p.id_plan_trabajo',request('id_plan_trabajo'))
                ->orderby('ac.id_plan_trabajo','desc')
                ->get();
                $plan = DB::table('plan_trabajo_asignacion as p')
                ->select('su.nombre as nombreSucursal', 'p.nombre as nombrePlan', 'p.id_plan_trabajo', 'p.id_sucursal')
                ->join('sucursales as su','p.id_sucursal','su.id_suscursal')                
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
                    return response()->json(['Actividades' => $lista_actividades_arr, 'Nombre' => $plan->nombrePlan, 'id_sucursal' => $plan->id_sucursal, 'sucursal' => $ac->nombreSucursal],200);
                }else{
                    return response()->json(['Actividades' => [], 'Nombre' => $plan->nombrePlan, 'id_sucursal' => $plan->id_sucursal, 'sucursal' => $plan->nombreSucursal],200);
                    
                }
            
        }
    }
}
