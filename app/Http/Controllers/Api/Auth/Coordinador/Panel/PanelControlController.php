<?php

namespace App\Http\Controllers\Api\Auth\Coordinador\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PanelControlController extends Controller
{
    public function listaSupervisores()
    {
        $user=DB::table('users as u')->where('u.id','=',Auth::id())->first();

       $coordinador=DB::table('coordinadores')
       ->where('correo','=',$user->email)
       ->first();

       $region=DB::table('region')
       ->where('id_cordinador','=',$coordinador->id_cordinador)
       ->first();

       $supervisores=DB::table('usuario_zona as uz')
        ->join('region as r','uz.id_region','=','r.id_region')
        ->join('usuarios_roles as ur','z.id_region','=','r.id_region')
        ->join('coordinadores as co','r.id_cordinador','=','co.id_cordinador')
        ->where('co.id_cordinador','=',$cordinador->id_cordinador)
        ->select('z.id_zona')
        ->get();
    }
}
