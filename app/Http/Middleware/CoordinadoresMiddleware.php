<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CoordinadoresMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
         //funcion que recibe un parametro que es un id para validar el tipo de usuario que haras las peticiones
         $user=DB::table('users as u')->where('u.id','=',Auth::id())->first();
         $admin = 0;
         //Obtener el correo de el usuario que se encuentra logueado en est caso el de la tabla cordinador
         $coordinador=DB::table('coordinadores as c')
         ->where('c.correo','=', $user->email)
         ->where('c.id_estado','=', 1)
         ->get();

         if(count($coordinador) < 1){
            $usuario = DB::table('usuario as u')->where('u.correo','=',$user->email)->where('u.estado','=', 1)->first();
            if($usuario){
               $admin = DB::table('usuarios_roles')->where('id_usuario','=',$usuario->id_usuario)->where('id_rol', 2)->first();
            }else{
               return response()->json('Usuario admin no encontrado',401); //dd('No tienes permiso');
            }
         }
         
         //Acceder al tipo de usuario que pertenece
         $usuarios_roles=Db::table('usuarios_roles as u')
         ->join('usuario as us','us.id_usuario','=','u.id_usuario')
         ->join('roles as r','r.id_roles','=','u.id_rol')
         ->where('us.correo','=',$user->email)
         ->first();
         
         //validar el tipo de usuario y madar a una ruta definida
         if(count($coordinador)>0 || $admin)
         {
            return $next($request);
         }else{
            return response()->json('No tienes permiso',401); //dd('No tienes permiso');
         }


    }
}
