<?php

namespace App\Http\Controllers\Api\Auth\Coordinador\Reporte;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


//rutas que obtienen datos que pueden acceder coordinador y supervisor
class RutasFreeController extends Controller
{   
    //lista de tipos de inputs de las plantillas
    public function inputs()
    {
        $inputs = DB::table('inputs_plantilla')->get();

        return response()->json($inputs,200);
    }
    //lista de las señalizaciones de la actividad de señalizacion
    public function senalizacion()
    {
        $senalizacion = DB::table('senalizacion_lista')->get();

        return response()->json($senalizacion,200);
    }

    
}
