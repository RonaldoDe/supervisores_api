<?php

namespace App\Http\Controllers\Api\Auth\Coordinador;

use Illuminate\Http\Request;
use Laravel\Passport\Client;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Modelos\PlanTrabajoAsignacion;
/*Author jhonatan cudris */
class CrearPlanesTrabajoController extends Controller
{
    //controlador que crea lsolo los planes de trabajo mas no las actividades
    //los para metro que recibes los manda el front de datos que obtiene de la sucursal y el supervisor
    //de la zona

    public function crearPlanTrabajo(Request $request)
    {//imortante mrar si se debe devolver el id del plan detrabajo enseguida para la signacion de las activdades plan de trabajo
        $validator=\Validator::make($request->all(),[
            'id_sucursal' => 'required',
            'fecha_creacion' => 'required',
            'id_supervisor'=>'required',


        ]);

        if($validator->fails())
        {
          return response()->json( $errors=$validator->errors()->all() );
        }

        else
        {

            $plan_trabajo =PlanTrabajoAsignacion::create([

                'id_sucursal' =>request('id_sucursal'),
                'fecha_creacion' =>request('fecha_creacion'),
                'id_supervisor' =>request('id_supervisor'),
                'estado'=>0,

            ]);

            //retorno del id creado en ese momento para asignarlo alas actividades
            return response()->json(["id_plan_trabajo"=>$plan_trabajo->id_plan_trabajo]);
        }

    }



}
