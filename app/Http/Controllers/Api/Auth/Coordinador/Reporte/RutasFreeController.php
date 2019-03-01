<?php

namespace App\Http\Controllers\Api\Auth\Coordinador\Reporte;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RutasFreeController extends Controller
{
    public function inputs()
    {
        $inputs = DB::table('inputs_plantilla')->get();

        return response()->json($inputs,200);
    }

    public function senalizacion()
    {
        $senalizacion = DB::table('senaliacion_lista')->get();

        return response()->json($senalizacion,200);
    }

    
}
