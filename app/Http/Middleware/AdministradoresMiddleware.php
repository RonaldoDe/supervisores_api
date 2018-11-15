<?php

namespace App\Http\Middleware;

use Closure;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdministradoresMiddleware
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
         $validacion_user=DB::table('usuario as us')->where('us.correo','=',$user->email)
         ->first();


        // exit;


         if($validacion_user!==null){
            $user_administrador=DB::table('usuarios_roles as ur')
            ->where('ur.id_usuario','=',$validacion_user->id_usuario)
            ->where('ur.id_rol','=',2)
            ->first();

            if(count($user_administrador)>0 ){
                return $next($request);
            }
           else{
               return response()->json('No tienes permiso',401); //dd('No tienes permiso');
            }
         }else{
            return response()->json('No tienes permiso',401); //dd('No tienes permiso');
         }




    }
}
