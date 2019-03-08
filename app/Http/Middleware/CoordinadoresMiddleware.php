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

         //Obtener el correo de el usuario que se encuentra logueado en est caso el de la tabla cordinador
         $coordinador=DB::table('coordinadores as c')
         ->where('c.correo','=', $user->email)
         ->where('c.id_estado','=', 1)
         ->get();

         if(!$coordinador){
            $usuario = DB::table('usuario as u')->where('u.id_usuario','=',$user->id)->first();
            if($usuario){
               $admin = DB::table('usuarios_roles')->where('id_usuario','=',$usuario->id_usuario)->where('id_rol', 2)->first();
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
