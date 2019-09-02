<?php

namespace App\Http\Controllers\Api\Auth\Coordinador\Reporte;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modelos\Seguimiento;
use App\Modelos\Usuario;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class AllInformationController extends Controller
{
    //toda la informacion de un coordinador
    public function alInformation(Request $request)
    {
        $user=DB::table('users as u')->where('u.id','=',Auth::id())->first();
        $coordinador=DB::table('coordinadores')->where('correo','=',$user->email)->first();

        if(!$coordinador){
            $usuario = DB::table('usuario as u')->where('u.correo','=',$user->email)->where('id_estado','=', 1)->first();
            if($usuario){
                $admin = DB::table('usuarios_roles')->where('id_usuario','=',$usuario->id_usuario)->where('id_rol', 2)->first();
                if($admin){
                    return response()->json('Usuario Administrador', 309);
                }else{
                    return response()->json('Usuario No es administrador', 400);
                }
            }else{
                return response()->json('Usuario no econtrado', 400);
            }
       }


       // Se recupera los datos del coordinador para mostrar su region y datos personales
       $region=DB::table('region as r')
                        ->join('coordinadores as c','c.id_cordinador','=','r.id_cordinador')
                        ->select('r.id_region','r.nombre as region','c.apellido','c.nombre','r.id_cordinador')
                        ->where('r.id_cordinador','=',$coordinador->id_cordinador)
                        ->first();

        //obtener zonas del coordinador
        $zonas=DB::table('zona as zo')
        ->select('zo.descripcion_zona', 'uz.id_region', 'zo.id_zona', 'uz.id_usuario')
        ->join('usuario_zona as uz','zo.id_zona','=','uz.id_zona')
        ->join('usuarios_roles as ur','uz.id_usuario','=','ur.id_usuario_roles')
        ->where('zo.id_region',$region->id_region)
        ->where('ur.id_rol', 1)
        ->get();

       $sucursales_array = array();
       $actividades_array = array();
        foreach($zonas as $zona){
            $sucursales=DB::table('sucursales as su')
            ->select('su.id_suscursal', 'su.cod_sucursal', 'su.nombre', 'su.id_zona', 'ur.id_usuario_roles', 'u.nombre as nombre_supervisor', 'u.apellido as apellido_supervisor')
            ->join('usuario_zona as uz', 'su.id_zona', 'uz.id_zona')
            ->join('usuarios_roles as ur', 'uz.id_usuario', 'ur.id_usuario_roles')
            ->join('usuario as u', 'ur.id_usuario', 'u.id_usuario')
            ->where('su.id_zona',$zona->id_zona)
            ->where('ur.id_rol',1)
            ->get();
            $sucursales_array = array_add($sucursales_array, $zona->descripcion_zona, $sucursales);
        }
        $planes=DB::table('plan_trabajo_asignacion as pt')
                ->where('pt.idcoordinador',$coordinador->id_cordinador)
                ->get();
        foreach ($planes as $plan) {
            $actividades = DB::table('actividades as ac')
            ->where('ac.id_plan_trabajo', $plan->id_plan_trabajo)
            ->orderby('ac.id_plan_trabajo','desc')
            ->get();
            $actividades_array = array_add($actividades_array, $plan->id_plan_trabajo, array());
            foreach($actividades as $ac){
                $activities = DB::table($ac->nombre_tabla. ' as ac')
                ->where('ac.id_plan_trabajo',$ac->id_plan_trabajo)
                ->get();
                foreach ($activities as $nameActividad) {
                    $nameActividad->nombreActividad = $ac->nombre_actividad;
                    array_push($actividades_array[$ac->id_plan_trabajo], $nameActividad);
                }
                //array_push($actividades_array[$ac->id_plan_trabajo], [$ac->nombre_actividad => $activities]);
            }
        }

        return response()->json(['zonas' => $zonas, 'sucursales' => $sucursales_array, 'planes' => $planes, 'actividades' => $actividades_array]);
    }

    public function alInformationAdmin(Request $request)
    {
       // Se recupera los datos del coordinador para mostrar su region y datos personales

        //obtener zonas del coordinador
        $zonas=DB::table('zona as zo')
        ->select('zo.descripcion_zona', 'uz.id_region', 'zo.id_zona', 'uz.id_usuario')
        ->join('usuario_zona as uz','zo.id_zona','=','uz.id_zona')
        ->join('usuarios_roles as ur','uz.id_usuario','=','ur.id_usuario_roles')
        ->where('ur.id_rol', 1)
        ->get();

       $sucursales_array = array();
       $actividades_array = array();
        foreach($zonas as $zona){
            $sucursales=DB::table('sucursales as su')
            ->select('su.id_suscursal', 'su.cod_sucursal', 'su.nombre', 'su.id_zona', 'ur.id_usuario_roles', 'u.nombre as nombre_supervisor', 'u.apellido as apellido_supervisor')
            ->join('usuario_zona as uz', 'su.id_zona', 'uz.id')
            ->join('usuarios_roles as ur', 'uz.id_usuario', 'ur.id_usuario_roles')
            ->join('usuario as u', 'ur.id_usuario', 'u.id_usuario')
            ->where('su.id_zona',$zona->id_zona)
            ->get();
            
            $sucursales_array = array_add($sucursales_array, $zona->descripcion_zona, $sucursales);
        }
        $planes=DB::table('plan_trabajo_asignacion as pt')
                ->get();
        foreach ($planes as $plan) {
            $actividades = DB::table('actividades as ac')
            ->where('ac.id_plan_trabajo', $plan->id_plan_trabajo)
            ->orderby('ac.id_plan_trabajo','desc')
            ->get();
            $actividades_array = array_add($actividades_array, $plan->id_plan_trabajo, array());
            foreach($actividades as $ac){
                $activities = DB::table($ac->nombre_tabla. ' as ac')
                ->where('ac.id_plan_trabajo',$ac->id_plan_trabajo)
                ->get();
                foreach ($activities as $nameActividad) {
                    $nameActividad->nombreActividad = $ac->nombre_actividad;
                    array_push($actividades_array[$ac->id_plan_trabajo], $nameActividad);
                }
                //array_push($actividades_array[$ac->id_plan_trabajo], [$ac->nombre_actividad => $activities]);
            }
        }

        return response()->json(['zonas' => $zonas, 'sucursales' => $sucursales_array, 'planes' => $planes, 'actividades' => $actividades_array]);
    }

    public function get_users(Request $request)
    {   
        # Here we get the amount of users active
        $users_active = Usuario::where('id_estado', 1)
        ->count();

        # Here we get the amount of users banned
        $users_banned = Usuario::where('id_estado', 2)
        ->count(); 

        //  $users_list = Usuario::select('id_usuario', 'nombre', 'apellido', 'cedula', 'correo', 'id_estado')
        //  ->paginate(15);

        $list = User::select('id', 'email')->get();

        $list_user_array = array();
        foreach ($list as $item) {
        $list_user = Usuario::select('id_usuario', 'nombre', 'apellido', 'cedula')
        ->where('correo', $item->email)->first();
            if($list_user){
                $list_user->id = $item->id;
                array_push($list_user_array, $list_user);
            }
        }
        
        $user_ids_array = array();
        foreach ($list as $item) {
            $user_id = User::select('id')
            ->where('id', $item->id)->first();
            array_push($user_ids_array, $user_id);
        }

        return response()->json(["response" =>['users_active'=>$users_active, 'users_banned'=>$users_banned, 'list_user' => 
        $list_user_array, 'user_ids' => $user_ids_array]], 200);
    }

    public function get_usage(Request $request)
    { 
        $validator=\Validator::make($request->all(),[
    		'days' => 'bail|numeric:required'
        ]);

        if($validator->fails())
        {
          return response()->json( $errors=$validator->errors()->all(),400 );
        }

        # Here we convert days to hours
        $days_to_hours = request('days') * 24;
        
        # We subtract an amount of hours to a time
        $subtract_day = strtotime ( '-'.$days_to_hours.' hour' , strtotime (date('Y-m-d H:i:s')));
        # From date
        $estimate_date = date('Y-m-d H:i:s', $subtract_day);

        # Here we perform the query that retrieves logged users in the last 24 hours
        $seguimiento = Seguimiento::whereBetween('logged_at', [$estimate_date, date('Y-m-d H:i:s')])->get();

        # We convert the queryset to a laravel collection
        $collection = collect($seguimiento);
        # We filtered out repeated user_id with unique
        $unique_list = $collection->unique('user_id');

        $array_users = array();
        foreach ($unique_list as $item) {
           array_push($array_users, $item->user_id);
        }
        
        # Lista de user_id y sus correos
        $list = User::select('id', 'email')->whereIn('id', $array_users)->get();
       

        // $array_users_emails = array();
        // foreach ($list as $users_email) {
        //    array_push($array_users_emails, $users_email->email);
        // }
        
        
        $list_user_array = array();
        foreach ($list as $item) {
        $list_user = Usuario::select('id_usuario', 'nombre', 'apellido', 'cedula')
        ->where('correo', $item->email)->first();
            if($list_user){
                $list_user->id = $item->id;
                array_push($list_user_array, $list_user);
            }
        }
        
        $user_ids_array = array();
        foreach ($list as $item) {
            $user_id = User::select('id')
            ->where('id', $item->id)->first();
            array_push($user_ids_array, $user_id);
        }
        
        # Here we get the amount of logged users
        $unique = $unique_list->count();
    
        //extraer los correos, y los colocas en un arreglo
        return response()->json(["response" => ['user_count' => $unique, 'list_user' => $list_user_array, 'user_ids' => $user_ids_array]], 200);
    }

    public function get_user_usage(Request $request, $id)
    { 
        $user = User::select('id', 'email')->where('id', $id)->first();

        # Here we get log in history of a user
        $seguimiento = Seguimiento::select('logged_at')
        ->where('user_id', $id)
        ->orderBy('logged_at', 'desc')
        ->paginate(15);

        $user_data = Usuario::select('id_usuario', 'nombre', 'apellido', 'cedula')
        ->where('correo', $user->email)->get();

        //$user_data = $user_data->user_id;
    
        //extraer los correos, y los colocas en un arreglo
        return response()->json(["response" => ['user_data' => $user_data, 'history' => $seguimiento]], 200);
    }
}
