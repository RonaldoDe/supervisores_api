<?php

namespace App\Http\Controllers\Api\Auth\Supervisores;

use Illuminate\Http\Request;
use Laravel\Passport\Client;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Modelos\Usuario;
use App\Modelos\Usuario_roles;


class HomeSupervisorController extends Controller
{
/*Author Ronaldo camacho */

    public function index(Request $request)
    {

        if($this->rutearMovil(Auth::id()))
        {
            //Se recupera los datos del usuario que se ha autenticado
            $user=DB::table('users as u')->where('u.id','=',Auth::id())->first();
            $user_supervisor=DB::table('usuario as u')->where('u.correo','=',$user->email)->first();

            return response()->json(['message' => 'Hello '.$user_supervisor->nombre]);
            
        }else{
            return response()->json(['message' => 'Malo']);

        }



    }

}
