<?php

namespace App\Http\Controllers\Api\Auth\Coordinador\Actividades;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\Auth\Coordinador\Actividades\MultiActividadController;
use App\Modelos\PlanTrabajoAsignacion;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Modelos\Actividades\ActividadesTabla;

class GenerarMultiActividadesController extends MultiActividadController
{
    public function generarMultiActividades(Request $request)
    {
        $validator=\Validator::make($request->all(),[
            'lista_actividades.*.nombre'=>'required',
            'lista_actividades.*.nombre_tabla'=>'required',
            'lista_sucursales.*.id_sucursal' => 'required',
            'lista_sucursales.*.id_supervisor' => 'required',
            'fecha_inicio' => 'date_format:"Y-m-d"|required|date',
            'fecha_fin' => 'date_format:"Y-m-d"|required|date',
        ]);
        if($validator->fails())
        {
          return response()->json( $errors=$validator->errors()->all() );
        }

        else
        {
            $requestSucursales=request("lista_sucursales");
            $lista=json_encode($requestSucursales,true);
            // //decodificcion del reques recibido para iterar el aary
            $listaSucursales=json_decode($lista);
            
            if(request('id_plan_trabajo') == null){

                $date = Carbon::now("America/Bogota");
                $day=$date->toDateTimeString();

                //obtener el id del cordinador logueado
                $user=DB::table('users as u')->where('u.id','=',Auth::id())->first();
                $cordinador=DB::table('coordinadores')
                ->select('id_cordinador')
                ->where('correo','=',$user->email)
                ->first();

                if($cordinador!==null){

                    
                    DB::beginTransaction();
                    foreach ($listaSucursales as $sucursal) {
                        if(request('nombre_plan') != null){
                            $plan_trabajo =PlanTrabajoAsignacion::create([
    
                                'id_sucursal' =>$sucursal->id_sucursal,
                                'fecha_creacion' =>$day,
                                'id_supervisor' =>$sucursal->id_supervisor,
                                'nombre' =>request('nombre_plan'),
                                'estado'=>1,
                                'idcoordinador' =>$cordinador->id_cordinador,
        
                            ]);
                        }else{
                            $plan_trabajo =PlanTrabajoAsignacion::create([

                                'id_sucursal' =>$sucursal->id_sucursal,
                                'fecha_creacion' =>$day,
                                'id_supervisor' =>$sucursal->id_supervisor,
                                'estado'=>1,
                                'idcoordinador' =>$cordinador->id_cordinador,
        
                            ]);
                        }
                        if($plan_trabajo){

                            $array_actividades=request('lista_actividades');
                            $lista_actividades=json_encode($array_actividades,true);
                            $actividades=json_decode($lista_actividades);

                        foreach ($actividades as $actividad) {
                            
                                $validarActividades = DB::table('actividades')
                                ->where('id_plan_trabajo', $plan_trabajo->id_plan_trabajo)
                                ->where('nombre_tabla', $actividad->nombre_tabla)
                                ->first();

                                if($validarActividades == null){
                                    $actividadAux =ActividadesTabla::create([

                                        'id_plan_trabajo' =>$plan_trabajo->id_plan_trabajo,
                                        'id_prioridad' =>1,
                                        'nombre_tabla' =>$actividad->nombre_tabla,
                                        'nombre_actividad'=>$actividad->nombre
                    
                                        ]);
                                    
                                }
                                if($actividadAux){
                                    $tabla = $actividad->nombre_tabla;
                                    if(method_exists($this, $tabla)){
                                        $params = [
                                            'id_plan_trabajo' => $plan_trabajo->id_plan_trabajo
                                        ];
                                        $request->request->add($params);
                                        $validar=$this->$tabla($request);
                                        echo $validar;
                                    }else{
                                        return response()->json(['message' => 'El metodo no existe', 'metodo' => $actividad->nombre_tabla],400);
                                    }    
                                }
                        }
                    }
                }
                DB::commit();
                return response()->json(["success"=>"Creado"],200);

                }else{

                    return response()->json(["success"=>"no existe el corrdinador"],400);
                }

            }

            
               
        }
    }
}
