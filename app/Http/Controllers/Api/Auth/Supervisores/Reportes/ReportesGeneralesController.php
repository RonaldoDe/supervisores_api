<?php

namespace App\Http\Controllers\Api\Auth\Supervisores\Reportes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportesGeneralesController extends Controller
{
    public function reporteSucursal(Request $request)
    {
        $validator=\Validator::make($request->all(),[
            'nombre_reporte' => 'required',
            'observaciones' => 'required',
            'foto' => 'required',
        ]);
        if($validator->fails())
        {
          return response()->json( ['message' => $validator->errors()->all()],400);
        }

        else
        {

        }
    }
}
