<?php

namespace App\Http\Controllers\Api\Auth\Supervisores;

use Illuminate\Http\Request;
use Laravel\Passport\Client;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Modelos\Usuario;
use App\Modelos\Usuario_roles;


class HomeSupervisorController extends Controller
{
/*Author Ronaldo camacho */

    public function index(Request $request)
    {

        //Se recupera los datos del usuario que se ha autenticado
       $user=DB::table('users as u')->where('u.id','=',Auth::id())->first();
       //obtener los datos del usuario supervisor
       $user_supervisor=DB::table('usuario as u')->where('u.correo','=',$user->email)->first();
        
       $plan_trabajo = DB::table('sucursales as su')
       ->select('su.id_suscursal', 'su.cod_sucursal', 'su.latitud', 'su.longitud', 'u.nombre', 'u.apellido', 'ur.id_usuario_roles', 'zo.descripcion_zona', 'zo.id_zona')
       ->join('zona as zo','su.id_zona','=','zo.id_zona')
       ->join('usuarios_roles as ur', 'zo.id_usuario_roles','=','ur.id_usuario_roles')
       ->join('usuario as u','ur.id_usuario','=','u.id_usuario')
       ->where('ur.id_usuario',$user_supervisor->id_usuario)
       ->get();

        return response()->json($plan_trabajo);

    }

}
