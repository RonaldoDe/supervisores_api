<?php

namespace App\Http\Controllers\Api\Auth\Coordinador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class BuscadoresController extends Controller
{
    public function searchProducts(Request $reques)
    {
        $producto=request('nombre_producto');

        $productos = DB::table('productos')
        ->select('codigo, nombre_comercial, id_laboratorio_id')
        ->where('nombre_comercial', 'LIKE', '%'.$producto.'%')
        ->take(10)
        ->get();

        return response()->json($productos);
    }
}
