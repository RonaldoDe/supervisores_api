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
            'nombre_tabla' => 'required',
    
        ]);
        if($validator->fails())
        {
          return response()->json( $errors=$validator->errors()->all() );
        }

        else
        {
            
            //guarda el nombre de la tabla de la actividad
            $tabla = request('nombre_tabla');
            
            //valida la tabla y llama la funcion del controlador que inserta y valida los datos de la actividad
            if(method_exists($this, $tabla)){
                $validar=$this->$tabla($request);
                return $validar;
            }else{
                return response()->json(['message' => 'El metodo no existe'],400);
            }
        }       
 
    }
}
