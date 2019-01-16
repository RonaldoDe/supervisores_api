<?php

namespace App\Http\Controllers\Api\Auth\Coordinador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class BuscadoresController extends Controller
{
    public function searchProducts(Request $request)
    {
        $validator=\Validator::make($request->all(),[
            'nombre_producto' => 'required',
        ]);

        if($validator->fails())
        {
          return response()->json( $errors=$validator->errors()->all(),400 );
        }

        else
        {
            $producto=request('nombre_producto');

            if(request('laboratorio') != null){
                $productos = DB::table('productos')
                ->select('codigo', 'nombre_comercial', 'laboratorio_id')
                ->orderBy('nombre_comercial', 'ASC')
                ->where('nombre_comercial', 'LIKE', '%'.$producto.'%')
                ->paginate(10);
            }else{
                $productos = DB::table('productos')
                ->select('codigo', 'nombre_comercial', 'laboratorio_id')
                ->orderBy('nombre_comercial', 'ASC')
                ->where('nombre_comercial', 'LIKE', '%'.$producto.'%')
                ->where('laboratorio_id', request('laboratorio'))
                ->paginate(10);
            }

            return response()->json(["productos"=>$productos],200);
        }
    }

    public function searchLaboratories(Request $request)
    {
        $validator=\Validator::make($request->all(),[
            'laboratorio' => 'required',
        ]);

        if($validator->fails())
        {
          return response()->json( $errors=$validator->errors()->all(),400 );
        }

        else
        {
            $laboratorio=request('laboratorio');
            $laboratorios = DB::table('laboratorio')
            ->select('dk', 'nombre')
            ->orderBy('nombre', 'ASC')
            ->where('nombre', 'LIKE', '%'.$laboratorio.'%')
            ->paginate(10);

            return response()->json(["laboratorios"=>$laboratorios],200);
        }
    }
}
