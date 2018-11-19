<?php

namespace App\Http\Controllers\Api\Auth\Supervisores;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActividadesController extends Controller
{
    public function index(Request $request)
    {
        $tabla = request('nombre_tabla');
        $validar=$this->$tabla($request);
        return $validar;
 
    }
}
