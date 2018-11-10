<?php

namespace App\Http\Controllers\Api\Auth\Coordinador;

use Illuminate\Http\Request;
use Laravel\Passport\Client;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Modelos\PlanTrabajoAsignacion;

class CrearPlanesTrabajoController extends Controller
{
    //controlador que crea lsolo los planes de trabajo mas no las actividades
    //los para metro que recibes los manda el front de datos que obtiene de la sucursal y el supervisor
    //de la zona

    public function crearPlanTrabajo(Request $request)
    {
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

            ]);

        }

    }



}
