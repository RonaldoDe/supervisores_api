<?php

namespace App\Http\Controllers\Api\Auth\Coordinador;

use Illuminate\Http\Request;
use Laravel\Passport\Client;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Modelos\PlanTrabajoAsignacion;
use Carbon\Carbon;
/*Author jhonatan cudris */
class CrearPlanesTrabajoController extends Controller
{
    //controlador que crea lsolo los planes de trabajo mas no las actividades
    //los para metro que recibes los manda el front de datos que obtiene de la sucursal y el supervisor
    //de la zona

    public function crearPlanTrabajo(Request $request)
    {//imortante mrar si se debe devolver el id del plan detrabajo enseguida para la signacion de las activdades plan de trabajo
        $validator=\Validator::make($request->all(),[
            'id_sucursal' => 'required|numeric',
           // 'fecha_creacion' => 'date_format:"Y-m-d H:i:s"|required',
            'id_supervisor'=>'required|numeric',


        ]);

        if($validator->fails())
        {
          return response()->json( $errors=$validator->errors()->all() );
        }

        else
        {
            $date = Carbon::now("America/Bogota");
            $day=$date->toDateTimeString();

            //obtener el id del cordinador logueado
            $user=DB::table('users as u')->where('u.id','=',Auth::id())->first();
            $cordinador=DB::table('coordinadores')
            ->select('id_cordinador')
            ->where('correo','=',$user->email)
            ->first();

            if($cordinador!==null){


            $plan_trabajo =PlanTrabajoAsignacion::create([

                'id_sucursal' =>request('id_sucursal'),
                'fecha_creacion' =>$day,
                'id_supervisor' =>request('id_supervisor'),
                'estado'=>0,
                'idcoornidador' =>$cordinador->id_cordinador,

            ]);
            return response()->json(["id_plan_trabajo"=>$plan_trabajo->id_plan_trabajo],201);

            }else{

                return response()->json(["error"=>"no hay existe el corrdinador"],400);
            }




            //retorno del id creado en ese momento para asignarlo alas actividades

        }

    }



}
