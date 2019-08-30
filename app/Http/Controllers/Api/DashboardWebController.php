<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardWebController extends Controller
{
    public function index(Request $request)
    {

      /*Author Ronaldo Camacho */

           //accediendo a los datos del usuario por medio de su ID
          $user=DB::table('users as u')->where('u.id','=',Auth::id())->first();

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
            return response()->json( $ruta="ruta/coordinadores", 200);
          }
          //%1 en la igualacion del rol es el id del usuario tipo supervisor que no puede acceder a la vista web  x
          else if($usuarios_roles->id_rol==1)
          {
              return response()->json(["error"=>"Error"],400);
          }
          else
          {
            return response()->json( $ruta="ruta/usuario/".$usuarios_roles->nombre_rol, 200);
          }













        }

    }
