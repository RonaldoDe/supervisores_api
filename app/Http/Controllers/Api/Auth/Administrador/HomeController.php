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
       ->select('u.id_usuario as id_cordinador', 'u.nombre', 'u.apellido', 'foto', 'correo')
       ->where('u.correo','=',$user->email)->first();
       $user_supervisor->id_region = 'Todas las regiones';
       $user_supervisor->region = 'Administrador';

        //obtener el id del rol del usuario
       $usuario_rol = DB::table('usuarios_roles as ur')
       ->where('ur.id_usuario',$user_supervisor->id_cordinador)
       ->first();

       $zonas=DB::table('zona as z')
                ->join('region as r','r.id_region','=','z.id_region')
                ->join('usuario_zona as uz','z.id_zona','=','uz.id_zona')
                ->join('usuarios_roles as u','u.id_usuario_roles','=','uz.id_usuario')
                ->join('roles as ro','ro.id_roles','=','u.id_rol')
                ->join('usuario as us','us.id_usuario','=','u.id_usuario')
                ->join('coordinadores as c','c.id_cordinador','=','r.id_cordinador')
                //->join('sucursales as s','s.id_zona','=','z.id_zona')
                ->where('u.id_rol','=',1)
                ->select('r.id_region', 'r.nombre as nombre_region', 'c.nombre', 'c.apellido', 'z.descripcion_zona','z.id_zona','us.nombre as supervisor','uz.id_usuario as id_usuario_supervisor',
                DB::raw("concat(us.nombre,' ',us.apellido) as supervisor"))
                ->get();
                


        return response()->json(['region' => $user_supervisor, 'zonas' => $zonas, 'foto' => $user_supervisor->foto, 'email' => $user_supervisor->correo, 'nombre' => $user_supervisor->nombre],200);
      
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

    public function mostrarPlanSucursal(Request $request)
    {
        $validator=\Validator::make($request->all(),[
            'id_zona' => 'required',
            'id_sucursal' => 'required',
            'fecha_inicio' => 'date_format:Y-m-d|before_or_equal:fecha_fin', 
            'fecha_fin' => 'date_format:Y-m-d|after_or_equal:fecha_inicio',

        ]);

        if($validator->fails())
        {
          return response()->json( $errors=$validator->errors()->all(),400 );
        }

        else
        {
            $user=DB::table('users as u')->where('u.id','=',Auth::id())->first();

            //validar si la sucursal pertenece al coordinador
            $perteneciente = DB::table('region as re')
            ->join('zona as zo' , 're.id_region', 'zo.id_region')
            ->join('sucursales as su' , 'zo.id_zona', 'su.id_zona')
            ->where('zo.id_zona', request('id_zona'))
            ->where('su.id_suscursal', request('id_sucursal'))
            ->first();
            
            if($perteneciente != null){
                if(request('fecha_inicio') != '' || request('fecha_fin') != ''){
                    $planes = DB::table('plan_trabajo_asignacion')
                    ->where('id_sucursal', request('id_sucursal'))
                    ->whereBetween('fecha_creacion', [request('fecha_inicio').' 00:00:00', request('fecha_fin').' 00:00:00'])
                    ->get();
                }else{
                    $planes = DB::table('plan_trabajo_asignacion')
                    ->where('id_sucursal', request('id_sucursal'))
                    ->get();
                }
                
                if(count($planes) > 0){
                    return response()->json($planes, 200);
                }else{
                    return response()->json('No tiene planes asignados', 402);
                }
            }else{
                    return response()->json('Sucursal no encontrada', 402);
            }
        }
    }

    public function mostrarPuntosVentasIdZona(Request $request, $id){
        /*Author jhonatan cudris */
               //function que recibe un parametro que sera el id de la zona y debuelve todos los puntos de venta que
               //con su supervisor que tiene asiganado el filtro lo hace por el id de la zona que tienen dichos puntos de venta
               $sw=0;
               $user=DB::table('users as u')->where('u.id','=',Auth::id())->first();
                
        
               $zona=DB::table('zona as z')
                ->select('z.id_zona', 'z.id_region')
                ->get();

                $coordinador=DB::table('zona as z')
                ->join('region as r','z.id_region','=','r.id_region')
                ->join('coordinadores as c','r.id_cordinador','=','c.id_cordinador')
                ->select('z.id_zona', 'z.id_region', 'c.nombre', 'c.apellido')
                ->where('z.id_zona', $id)
                ->first();
        
        
                   foreach($zona as $valor){
                       if($valor->id_zona ==$id){
                        $sw=$sw+1;
                       }
        
                   }
        
        
                    if($sw>0){
                        $array_num_plan_trabajo = array();
        
                        $sucursal=DB::table('sucursales as s')
                        ->join('zona as zo','s.id_zona','=','zo.id_zona')
                        ->join('usuario_zona as uz','zo.id_zona','=','uz.id_zona')
                        ->join('usuarios_roles as ur','uz.id_usuario','=','ur.id_usuario_roles')
                        ->join('usuario as us','ur.id_usuario','=','us.id_usuario')
                        ->where('s.id_zona','=',$id)
                        ->where('ur.id_rol', 1)
                        ->where('uz.id_estado', 1)
                        ->select('zo.descripcion_zona','s.id_suscursal','s.cod_sucursal','s.nombre as sucursal','ur.id_usuario_roles as id_supervisor',
                        DB::raw("concat(us.nombre,' ',us.apellido) as supervisor"))
                        ->get();

                         //$sucur abrebiacion de sucursal almacena una sucursal por separado
                foreach ($sucursal as $sucur) {
                    $plan = DB::table('plan_trabajo_asignacion')
                    ->where('id_sucursal', $sucur->id_suscursal)
                    ->get();

                    $array_num_plan_trabajo = array_add($array_num_plan_trabajo, $sucur->id_suscursal, count($plan));
                }
        
                    $zona=DB::table('zona')->where('zona.id_zona','=',$id)->first();
                    return response()->json(["sucursal"=>$sucursal,"zona"=>$zona,"numero_plan" => $array_num_plan_trabajo, 'nombre' => $coordinador->nombre, 'apellido' => $coordinador->apellido],200);
                    }else{
                        return response()->json(["error"=>'esta zona no existe para este coordinador'],400);
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
                $zona = DB::table('usuario_zona as z')
                ->select('su.cod_sucursal', 'su.nombre', 'su.direccion', 'z.id_usuario', 'usu.nombre as nombre_usuario', 'usu.apellido', 'su.id_zona')
                ->join('region as r', 'r.id_region', 'z.id_region')
                ->join('sucursales as su', 'z.id_zona', 'su.id_zona')
                ->join('usuarios_roles as ur', 'z.id_usuario', 'ur.id_usuario_roles')
                ->join('usuario as usu', 'ur.id_usuario', 'usu.id_usuario')
                ->where('su.id_suscursal', request('id_sucursal'))
                ->first();
                if($zona != null){
                    
                    return response()->json($zona,201);
                }else{
                    return response()->json('sucursal no encontrada.',400);
                }

        }
    }
    
}
