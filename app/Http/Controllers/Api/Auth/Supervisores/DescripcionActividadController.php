<?php

namespace App\Http\Controllers\Api\Auth\Supervisores;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DescripcionActividadController extends Controller
{
    public function description(Request $request)
    {

        $validator=\Validator::make($request->all(),[
    		'nombre_tabla' => 'required',
        ]);

        if($validator->fails())
        {
         
          //return response()->json(['errors'=>$validator->errors()->all()]);
          // return response()->json( $datos='nO ' );
          return response()->json( $errors=$validator->errors()->all(), 401);
        }
        else
        {
            $descripcion = DB::table('nombre_actividades')
            ->select('descripcion')
            ->where('tabla',request('nombre_tabla'))
            ->first();

            if($descripcion != null){
                return response()->json(['message' => $descripcion], 201);
            }else{
                return response()->json(['message' => 'Nombre de tabla no adminita'], 202);
            }

        }
    }
}
