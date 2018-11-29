<?php

namespace App\Http\Controllers\Api\Auth\Coordinador\Reporte;

use Illuminate\Http\Request;
use Laravel\Passport\Client;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Modelos\PlanTrabajoAsignacion;
use Carbon\Carbon;

class CrearReportesPlanesTrabajo extends Controller
{

    public function mostrarReportePorCordinador(){

        $user=DB::table('users as u')->where('u.id','=',Auth::id())->first();
        $cordinador=DB::table('coordinadores')
        ->select('id_cordinador')
        ->where('correo','=',$user->email)
        ->first();



    }

}
