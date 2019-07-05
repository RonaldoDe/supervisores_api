<?php

namespace App\Http\Controllers\Api\Auth\Coordinador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;

class PanelControlController extends Controller
{
    public function listaSupervisores()
    {

        //otener usuario
        $user=DB::table('users as u')->where('u.id','=',Auth::id())->first();

        //otener usuario coordinador
       $coordinador=DB::table('coordinadores')
       ->where('correo','=',$user->email)
       ->first();


       $region=DB::table('region')
       ->where('id_cordinador','=',$coordinador->id_cordinador)
       ->first();
        // obtener supervisores del coordinador
       $supervisores=DB::table('usuario_zona as uz')
        ->join('region as r','uz.id_region','=','r.id_region')
        ->join('usuarios_roles as ur','uz.id_usuario','=','ur.id_usuario_roles')
        ->join('usuario as us','ur.id_usuario','=','us.id_usuario')
        ->join('coordinadores as co','r.id_cordinador','=','co.id_cordinador')
        ->where('co.id_cordinador','=',$coordinador->id_cordinador)
        ->select('ur.id_usuario_roles', 'us.nombre', 'us.apellido', 'us.cedula', 'us.correo', 'us.telefono')
        ->get();

        return response()->json($supervisores, 200);
    }
}
