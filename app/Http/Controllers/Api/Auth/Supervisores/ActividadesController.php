<?php

namespace App\Http\Controllers\Api\Auth\Supervisores;

use Illuminate\Http\Request;
use App\Http\Controllers\ValidarActividadesController;


class ActividadesController extends ValidarActividadesController
{
    public function index(Request $request)
    {   
        //validacion de los datos de la actividad
        $validator=\Validator::make($request->all(),[
            'id_plan_trabajo' => 'required',
            'id_actividad' => 'required',
            'observaciones' => 'required',
            'calificacion' => 'required',
            'calificacion_pv' => 'required',
            'nombre_tabla' => 'required',
    
        ]);
        if($validator->fails())
        {
          return response()->json( $errors=$validator->errors()->all() );
        }

        else
        {

             //guada el nombre de la tabla de la actividad
            $tabla = request('nombre_tabla');
            //valida la tabla y llama la funcion del controlador
            $validar=$this->$tabla($request);
            return $validar;
        }
       
 
    }
}
