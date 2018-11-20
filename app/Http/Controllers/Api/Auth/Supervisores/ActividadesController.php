<?php

namespace App\Http\Controllers\Api\Auth\Supervisores;

use Illuminate\Http\Request;
use App\Http\Controllers\ValidarActividadesController;


class ActividadesController extends ValidarActividadesController
{
    public function index(Request $request)
    {   
        //guada el nombre de la tabla de la actividad
        $tabla = request('nombre_tabla');
        //valida la tabla y llama la funcion del controlador
        $validar=$this->$tabla($request);
        return $validar;
 
    }
}
