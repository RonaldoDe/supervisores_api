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
          return response()->json( $errors=$validator->errors()->all(),400 );
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

                //crear plan de trabajo
            $plan_trabajo =PlanTrabajoAsignacion::create([

                'id_sucursal' =>request('id_sucursal'),
                'fecha_creacion' =>$day,
                'id_supervisor' =>request('id_supervisor'),
                'estado'=>1,
                'idcoordinador' =>$cordinador->id_cordinador,

            ]);
            return response()->json(["id_plan_trabajo"=>$plan_trabajo->id_plan_trabajo],201);

            }else{

                return response()->json(["success"=>"no existe el corrdinador"],400);
            }




            //retorno del id creado en ese momento para asignarlo alas actividades

        }

    }
    //actualizar o asiganar el nombre a un plan de trabajo
    public function ActualizarNombrePlanTrabajo (Request $request)
    {
        $validator=\Validator::make($request->all(),[
            'id_plan_trabajo' => 'required',
            'nombre_plan'=>'required',


        ]);

        if($validator->fails())
        {
          return response()->json( $errors=$validator->errors()->all(),400 );
        }

        else
        {
            //validar si el plan existe
            $plan = PlanTrabajoAsignacion::find(request('id_plan_trabajo'));
            if($plan != null){
                $plan->nombre=request('nombre_plan');
                $plan->update();
                if($plan){
                    $update_nombre = DB::table('notificaciones')
                    ->where('id_plan_trabajo', request('id_plan_trabajo'))
                    ->update(['nombre_plan' => request('nombre_plan')]);
                }
                return response()->json('Nombre de plan actualizado',200);
            }else{
                return response()->json('Plan de trabajo no encontrado.',202);

            }
        }

    }

    public function mostrarPlanSucursal(Request $request)
    {
        $validator=\Validator::make($request->all(),[
            'id_zona' => 'required',
            'id_sucursal' => 'required',
            'fecha_inicio' => 'date_format:Y-m-d|before_or_equal:fecha_fin', 
            'fecha_fin' => 'date_format:Y-m-d|after_or_equal:fecha_inicio',

        ]);

        if($validator->fails())
        {
          return response()->json( $errors=$validator->errors()->all(),400 );
        }

        else
        {
            $user=DB::table('users as u')->where('u.id','=',Auth::id())->first();
            $coordinador=DB::table('coordinadores')->where('cedula',$user->cedula)->first();
            if(!$coordinador){
                $usuario = DB::table('usuario as u')->where('u.correo','=',$user->email)->where('id_estado','=', 1)->first();
                if($usuario){
                    $admin = DB::table('usuarios_roles')->where('id_usuario','=',$usuario->id_usuario)->where('id_rol', 2)->first();
                    if($admin){
                        return response()->json('Usuario Administrador', 309);
                    }else{
                        return response()->json('Usuario No es administrador', 400);
                    }
                }else{
                    return response()->json('Usuario no econtrado', 400);
                }
           }

            //validar si la sucursal pertenece al coordinador
            $perteneciente = DB::table('region as re')
            ->join('zona as zo' , 're.id_region', 'zo.id_region')
            ->join('sucursales as su' , 'zo.id_zona', 'su.id_zona')
            ->where('re.id_cordinador', $coordinador->id_cordinador)
            ->where('zo.id_zona', request('id_zona'))
            ->where('su.id_suscursal', request('id_sucursal'))
            ->first();
            
            if($perteneciente != null){
                if(request('fecha_inicio') != '' || request('fecha_fin') != ''){
                    $planes = DB::table('plan_trabajo_asignacion')
                    ->where('id_sucursal', request('id_sucursal'))
                    ->whereBetween('fecha_creacion', [request('fecha_inicio').' 00:00:00', request('fecha_fin').' 00:00:00'])
                    ->get();
                }else{
                    $planes = DB::table('plan_trabajo_asignacion')
                    ->where('id_sucursal', request('id_sucursal'))
                    ->get();
                }
                
                if(count($planes) > 0){
                    return response()->json($planes, 200);
                }else{
                    return response()->json('No tiene planes asignados', 402);
                }
            }else{
                    return response()->json('Sucursal no encontrada', 402);
            }
        }
    }


}
