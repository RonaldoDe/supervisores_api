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
        // validar los datos de las actividades y arrays
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
            $fecha= date('Y-m-d');
            //valida que la fecha inicio sea mayor que la fecha actual y que la fecha fin
            if(request('fecha_inicio')>=$fecha && request('fecha_inicio')<=request('fecha_fin')){
            //lista de sucursales
            $requestSucursales=request("lista_sucursales");
            //convertir para poder iterar en el foreach
            $lista=json_encode($requestSucursales,true);
            //decodificacion del reques recibido para iterar el aary
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
                    //iterar la sucursales y crear plan si no existe
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
                            //iterar actvidades
                            $array_actividades=request('lista_actividades');
                            $lista_actividades=json_encode($array_actividades,true);
                            $actividades=json_decode($lista_actividades);

                        foreach ($actividades as $actividad) {
                                // obtener plan de trabajo segun sucursal
                                $planesSucursal = DB::table('plan_trabajo_asignacion')
                                ->where('id_sucursal', $sucursal->id_sucursal)
                                ->orderBy('id_sucursal', 'desc')
                                ->get();
                                //obtener actividades excluyendo los ptc
                                foreach($planesSucursal as $planSucursal){
                                    if($actividad->nombre_tabla != 'actividades_ptc'){
                                        $validarDuplicadoFechas = DB::table($actividad->nombre_tabla)
                                        ->select('id', 'fecha_inicio', 'fecha_fin', 'id_plan_trabajo')
                                        ->where('id_plan_trabajo', $planSucursal->id_plan_trabajo)
                                        ->where('id_estado', 1)
                                        ->get();
                                        //validar que las fechas dadas no se encuentren en ningun rango de fechas
                                        if(count($validarDuplicadoFechas) > 0){
                                            foreach ($validarDuplicadoFechas as $fechasDuplicadas) {
                                                if(request('fecha_inicio').' 00:00:00' >= $fechasDuplicadas->fecha_inicio && request('fecha_inicio').' 00:00:00' <= $fechasDuplicadas->fecha_fin){
                                                    return response()->json(['La fecha inicio se encuentra en el rango de fechas de otra actividad '. $actividad->nombre],400);
                                                    
                                                }

                                                if(request('fecha_fin').' 23:59:00' >= $fechasDuplicadas->fecha_inicio && request('fecha_fin').' 23:59:00' <= $fechasDuplicadas->fecha_fin){
                                                    return response()->json(['La fecha fin se encuentra en el rango de fechas de otra actividad '. $actividad->nombre],400);
                                                }

                                                if($fechasDuplicadas->fecha_inicio >= request('fecha_inicio').' 00:00:00' && $fechasDuplicadas->fecha_inicio <= request('fecha_fin').' 23:59:00'){
                                                    return response()->json(['Ya existe una actividad que se encuentra en el rango de fechas '. $actividad->nombre],400);
                                                    
                                                }

                                                if($fechasDuplicadas->fecha_fin >= request('fecha_inicio').' 23:59:00' && $fechasDuplicadas->fecha_fin <= request('fecha_fin').' 23:59:00'){
                                                    return response()->json(['Ya existe una actividad que se encuentra en el rango de fechas '. $actividad->nombre],400);                                                    
                                                }
                                            }
                                        }
                                    }
                                }

                                //obtener actividad
                                $validarActividades = DB::table('actividades')
                                ->where('id_plan_trabajo', $plan_trabajo->id_plan_trabajo)
                                ->where('nombre_tabla', $actividad->nombre_tabla)
                                ->first();
                                //crear actividad en la tabla de actividades
                                if($validarActividades == null){
                                    $actividadAux =ActividadesTabla::create([

                                        'id_plan_trabajo' =>$plan_trabajo->id_plan_trabajo,
                                        'id_prioridad' =>1,
                                        'nombre_tabla' =>$actividad->nombre_tabla,
                                        'nombre_actividad'=>$actividad->nombre
                    
                                        ]);
                                    
                                }
                                //crear actividad
                                if($actividadAux){
                                    $tabla = $actividad->nombre_tabla;
                                    if(method_exists($this, $tabla)){

                                        if($actividad->nombre_tabla == 'actividades_ptc'){
                                            $params = [
                                                'id_plan_trabajo' => $plan_trabajo->id_plan_trabajo,
                                                'titulo' => $actividad->titulo,
                                                'data' => $actividad->data,
                                                'descripcion' => $actividad->descripcion
                                            ];
                                        }else{
                                            $params = [
                                                'id_plan_trabajo' => $plan_trabajo->id_plan_trabajo
                                            ];
                                        }

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

                    return response()->json(["success"=>"no existe el coordinador"],400);
                }

            }else{
                //si existe un plan de trabajo solo asignar
                $plan_trabajo = DB::table('plan_trabajo_asignacion')
                ->where('id_plan_trabajo', request('id_plan_trabajo'))
                ->first();
                if($plan_trabajo){
                    DB::beginTransaction();

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
                                        if($actividadAux){
                                            $tabla = $actividad->nombre_tabla;
                                            if(method_exists($this, $tabla)){
                                                if($actividad->nombre_tabla == 'actividades_ptc'){
                                                    $params = [
                                                        'id_plan_trabajo' => $plan_trabajo->id_plan_trabajo,
                                                        'titulo' => $actividad->titulo
                                                    ];
                                                }else{
                                                    $params = [
                                                        'id_plan_trabajo' => $plan_trabajo->id_plan_trabajo
                                                    ];
                                                }
                                                $request->request->add($params);
                                                $validar=$this->$tabla($request);
                                            }else{
                                                return response()->json(['message' => 'El metodo no existe', 'metodo' => $actividad->nombre_tabla],400);
                                            }    
                                        }else{
                                            return response()->json(['message' => 'Error al crear actividad en la tabla', 'actividad' => $actividad->nombre_tabla],400);
                                        }
                                }
                                
                }
            }else{
                return response()->json(['message' => 'El plan de trabajo no existe'],400);
            }
            DB::commit();
        }           
               
        }else{
        return response()->json(['message' => 'La fecha inicio debe ser mayor a la final y mayor que el dia actual'],400);

    }
    }
    }
}
