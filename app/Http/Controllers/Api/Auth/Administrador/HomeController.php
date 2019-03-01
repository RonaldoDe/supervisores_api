<?php

namespace App\Http\Controllers\Api\Auth\Administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function home()
    {
        //Se recupera los datos del usuario que se ha autenticado
       $user=DB::table('users as u')->where('u.id','=',Auth::id())->first();

       //obtener los datos del usuario supervisor
       $user_supervisor=DB::table('usuario as u')
       ->select('u.id_usuario', 'u.nombre', 'u.apellido', 'u.cedula', 'u.correo', 'u.telefono', 'u.codigo', 'u.foto')
       ->where('u.correo','=',$user->email)->first();

        //obtener el id del rol del usuario
       $usuario_rol = DB::table('usuarios_roles as ur')
       ->where('ur.id_usuario',$user_supervisor->id_usuario)
       ->first();

       $usuario_zona = DB::table('usuario_zona as uz')
       ->where('uz.id_usuario',$usuario_rol->id_usuario_roles)
       ->first();
    }
}
