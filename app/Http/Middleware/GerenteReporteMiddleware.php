<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class GerenteReporteMiddleware
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

        //Obtener el correo de el usuario que se encuentra logueado en est caso el de la tabla usuario
        $gerente=DB::table('usuario as us')
        ->where('us.correo','=', $user->email)
        ->where('us.id_estado','=', 1)
        ->get();

        //Acceder al tipo de usuario que pertenece
       $usuarios_roles=Db::table('usuarios_roles as u')
                          ->join('usuario as us','us.id_usuario','=','u.id_usuario')
                          ->join('roles as r','r.id_roles','=','u.id_rol')
                          ->where('us.correo','=',$user->email)
                          ->where('u.id_rol','=',4)
                          ->first();

        //validar el tipo de usuario y madar a una ruta definida
        if($usuarios_roles)
        {
           return $next($request);
        }else{
           return response()->json('No tienes permiso',400); //dd('No tienes permiso');
        };
    }
}
