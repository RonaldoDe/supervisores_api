<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\User;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;



    public function rutear($id)
    {
       /*Jhonatan cudris peralta */

           //funcion que recibe un parametro que es un id para validar el tipo de usuario que haras las peticiones
           $user=DB::table('users as u')->where('u.id','=',$id)->first();

           //Obtener el correo de el usuario que se encuentra logueado en est caso el de la tabla cordinador
           $coordinador=DB::table('coordinadores as c')
           ->where('c.correo','=', $user->email)
           ->get();

           //Acceder al tipo de usuario que pertenece
          $usuarios_roles=Db::table('usuarios_roles as u')
                             ->join('usuario as us','us.id_usuario','=','u.id_usuario')
                             ->join('roles as r','r.id_roles','=','u.id_rol')
                             ->where('us.correo','=',$user->email)
                             ->first();

           //validar el tipo de usuario y madar a una ruta definida
           if(count($coordinador)>0)
           {
             return "coordinador";
           }
           //%1 en la igualacion del rol es el id del usuario tipo supervisor que no puede acceder a la vista web  x
           else if($usuarios_roles->id_rol==1)
           {
               return "error";
           }
           //controlador que valida si es un administrador que se loguea
           else if($usuarios_roles->id_rol==2)
           {
            return "admin";

           }
           else
           {
            return  $usuarios_roles->nombre_rol;
           }

    }
}
