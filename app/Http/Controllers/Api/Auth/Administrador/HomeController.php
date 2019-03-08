<?php

namespace App\Http\Controllers\Api\Auth\Administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        //Se recupera los datos del usuario que se ha autenticado
       $user=DB::table('users as u')->where('u.id','=',Auth::id())->first();

       //obtener los datos del usuario supervisor
       $user_supervisor=DB::table('usuario as u')
       ->select('u.id_usuario', 'u.nombre', 'u.apellido', 'u.cedula', 'u.correo', 'u.telefono', 'u.codigo', 'u.foto')
       ->where('u.correo','=',$user->email)->first();

        //obtener el id del rol del usuario
       $usuario_rol = DB::table('usuarios_roles as ur')
       ->where('ur.id_usuario',$user_supervisor->id_usuario)
       ->first();

       $zonas=DB::table('zona as z')
        ->get();

        return response()->json(['zonas' => $zonas],200);
      
    }

    public function getSucursal(Request $request)
    {
        $validator=\Validator::make($request->all(),[
            'id_zona' => 'required',


        ]);

        if($validator->fails())
        {
          return response()->json( $errors=$validator->errors()->all(),400);
        }

        else
        {

            $sucursales=DB::table('sucursales')
            ->where('id_zona', request('id_zona'))
            ->get();

                return response()->json(['sucursales' => $sucursales],200);
        }
      
    }

    public function datosSucursal(Request $request)
    {
        $validator=\Validator::make($request->all(),[
            'id_sucursal' => 'required',


        ]);

        if($validator->fails())
        {
          return response()->json( $errors=$validator->errors()->all(),400);
        }

        else
        {

            $sucursales = DB::table('usuario_zona as z')
            ->select('su.cod_sucursal', 'su.nombre', 'su.direccion', 'z.id_usuario', 'usu.nombre as nombre_usuario', 'usu.apellido', 'su.id_zona')
            ->join('region as r', 'r.id_region', 'z.id_region')
            ->join('sucursales as su', 'z.id_zona', 'su.id_zona')
            ->join('usuarios_roles as ur', 'z.id_usuario', 'ur.id_usuario_roles')
            ->join('usuario as usu', 'ur.id_usuario', 'usu.id_usuario')
            ->where('su.id_suscursal', request('id_sucursal'))
            ->first();

            return response()->json(['sucursales' => $sucursales],200);
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

                //obtener las actividades segun su plan de trabajo 
                $actividades=DB::table('plan_trabajo_asignacion as p')
                ->select('su.nombre as nombreSucursal', 'p.nombre as nombrePlan', 'ac.nombre_tabla', 'p.id_plan_trabajo', 'ac.nombre_actividad')
                ->join('actividades as ac','p.id_plan_trabajo','ac.id_plan_trabajo')
                ->join('sucursales as su','p.id_sucursal','su.id_suscursal')
                ->where('p.id_plan_trabajo',request('id_plan_trabajo'))
                ->orderby('ac.id_plan_trabajo','desc')
                ->get();
                //obtener la sucursal asignada a una plan
                $plan = DB::table('plan_trabajo_asignacion as p')
                ->select('su.nombre as nombreSucursal', 'p.nombre as nombrePlan', 'p.id_plan_trabajo', 'p.id_sucursal')
                ->join('sucursales as su','p.id_sucursal','su.id_suscursal')                
                ->where('p.id_plan_trabajo', request('id_plan_trabajo'))
                ->first();
    
                if($plan){
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
                }else{
                    return response()->json(['Plan no econtrado'],400);

                }
                
            
        }
    }

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

                //obtener las actividades segun su plan de trabajo 
                $actividades=DB::table('plan_trabajo_asignacion as p')
                ->select('su.nombre as nombreSucursal', 'p.nombre as nombrePlan', 'ac.nombre_tabla','p.estado', 'p.id_plan_trabajo', 'ac.nombre_actividad')
                ->join('actividades as ac','p.id_plan_trabajo','ac.id_plan_trabajo')
                ->join('sucursales as su','p.id_sucursal','su.id_suscursal')
                ->where('p.id_plan_trabajo',request('id_plan_trabajo'))
                ->orderby('ac.id_plan_trabajo','desc')
                ->get();

                //obtener plan mediante su id
                $plan = DB::table('plan_trabajo_asignacion as p')
                ->where('p.id_plan_trabajo', request('id_plan_trabajo'))
                ->first();
    
                //array que almacenará las actividades
                $lista_actividades_arr = array();
                //bucle que itera las actividades y las obtiene segun el plan de trabajo
                foreach($actividades as $ac){
                    $fe = DB::table($ac->nombre_tabla. ' as ac')
                    ->where('ac.id_plan_trabajo',$ac->id_plan_trabajo)
                    ->where('ac.id_estado', '!=',2)
                    ->get();
    
                    //llenar array con las actividades
                    foreach($fe as $fecha){
                        $fecha->nombre_actividad = $ac->nombre_actividad;
                        array_push($lista_actividades_arr, [$ac->nombreSucursal =>$fecha]);
                    }
                    
                    
                }
                    
                    return response()->json(['Actividades' => $lista_actividades_arr, 'Nombre' => $plan->nombre, 'Sucursal' => $plan->id_sucursal, 'estado_plan' => $plan->estado],200);
                
            
        }
    }

    public function getPlanes(Request $request)
    {
        $validator=\Validator::make($request->all(),[
            'id_sucursal' => 'required',

        ]);

        if($validator->fails())
        {
          return response()->json( $errors=$validator->errors()->all(),400 );
        }

        else
        {
                //obtener plan mediante su id
                $planes = DB::table('plan_trabajo_asignacion as p')
                ->where('p.id_sucursal', request('id_sucursal'))
                ->get();
    
           
                return response()->json(['Planes' => $planes],200);
                
            
        }
    }
    
}
