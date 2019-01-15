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
        ->select('codigo', 'nombre_comercial', 'laboratorio_id')
        ->orderBy('nombre_comercial', 'ASC')
        ->where('nombre_comercial', 'LIKE', '%'.$producto.'%')
        ->get();

        return response()->json($productos);
    }
}
