<?php

namespace App\Http\Controllers\Api\Auth\Coordinador;

use Illuminate\Http\Request;
use Laravel\Passport\Client;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class HomeCoordinadorController extends Controller
{
    
    public function index(Request $request)
    {
        /*Author faby freitte*/
        
        //se valida que todas las peticiones entrantes al servidor solo funcionen via ajax de lo contrario saldra un error.
      if(!$request->ajax()){return redirect('/');}

       //Se recupera el dato del usuario que se ha autenticado
       $user=DB::table('users as u')->where('u.id','=',Auth::id())->first();

       // Se recupera los datos del coordinador para mostrar su region y datos personales
       $region=DB::table('region as r')
                        ->join('coordinadores as c','c.id_cordinador','=','r.id_cordinador')
                        ->select('r.nombre as region','r.nombre','c.apellido','c.nombre','r.id_cordinador')
                        ->where('c.correo','=',$user->email)
                        ->first();
      // Se recupera los datos de las zonas asociados a la region del coordinador autenticado
    $zonas=DB::table('zona as z')
                ->join('region as r','r.id_region','=','z.id_region')
                ->join('usuarios_roles as u','u.id_usuario_roles','=','z.id_usuario_roles')
                ->join('roles as ro','ro.id_roles','=','u.id_rol')
                ->join('usuario as us','us.id_usuario','=','u.id_usuario')
                ->join('coordinadores as c','c.id_cordinador','=','r.id_cordinador')
                ->join('sucursales as s','s.id_zona','=','z.id_zona')
                ->where('r.id_cordinador','=',$region->id_cordinador)
                ->select('z.descripcion_zona','z.id_zona','s.nombre as sucursal','s.id_suscursal','us.nombre as supervisor')         
                ->get();


       //se retorna por ajax la region y zonas como objetos de las consultas realizadas
     return response()->json([$region,$zonas]);
   

    }

    }
