<?php

namespace App\Http\Middleware;

use Closure;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class SupervisoresMiddleware
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

        //Obtener los datos del usuario
        $user=DB::table('users as u')->where('u.id','=',Auth::id())->first();
        //Comprobar los datos del user con la tabla usuarios
        $user_supervisor=DB::table('usuario as u')->where('u.correo','=',$user->email)->first();
        //Verificar si el usuario es tipo supervisor y existe en la tabla usuarios roles 
        $supervisor=DB::table('usuarios_roles as ur')
        ->where('ur.id_rol','=', 1)
        ->where('ur.id_usuario',$user_supervisor->id_usuario)
        ->get();
        if(count($supervisor)>0){
            return $next($request);
        }
        dd('No tienes permiso');
        
    }
}
