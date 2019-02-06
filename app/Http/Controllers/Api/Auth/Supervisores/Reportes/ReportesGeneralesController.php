<?php

namespace App\Http\Controllers\Api\Auth\Supervisores\Reportes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modelos\Reportes\ReporteSupervisor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Storage;
use App\Modelos\Reportes\MensajeReporte;


class ReportesGeneralesController extends Controller
{
    public function reporteSucursal(Request $request)
    {
        $validator=\Validator::make($request->all(),[
            'nombre_reporte' => 'required',
            'id_sucursal' => 'required',
            'nombre_sucursal' => 'required',
            'observaciones' => 'required',
        ]);
        if($validator->fails())
        {
          return response()->json( ['message' => $validator->errors()->all()],400);
        }

        else
        {
            //Se recupera los datos del usuario que se ha autenticado
            $user=DB::table('users as u')->where('u.id','=',Auth::id())->first();

            $supervisor=DB::table('usuario')
            ->where('correo','=',$user->email)->first();
            
            $usuario_rol=DB::table('usuarios_roles')
            ->where('id_usuario','=',$supervisor->id_usuario)->first();
            
           if($supervisor){
                $gerente = DB::table('usuarios_roles')
                ->where('id_usuario',$supervisor->id_usuario)->first();
           }else{
                $gerente = 0;
           }

            $region = DB::table('zona')
            ->where('id_usuario_roles','=',$usuario_rol->id_usuario_roles)->first();

            if($region){
                $coordinador = DB::table('region')
                ->where('id_region','=',$region->id_region)->first();
            }else{
                
                $zona = DB::table('sucursales')
                ->where('id_suscursal','=',request('id_sucursal'))->first();
                
                $region = DB::table('zona')
                ->where('id_zona','=',$zona->id_zona)->first();

                $coordinador = DB::table('region')
                ->where('id_region','=',$region->id_region)->first();
            }

            if($coordinador){

                $foto = 'imagen_reporte' . time();
                 
                $url_img = str_replace(" ", "_",'reportes/'.request('nombre_sucursal').'/'.request('nombre_reporte').'/'.$foto);

                 if (request('foto') != "") { // storing image in storage/app/public Folder
                    if(strpos(request('foto'), 'supervisores_api/storage/app/public/img/') == false ){
                        Storage::disk('public')->put('img/'.$url_img, base64_decode(request('foto')));
                        $reporte = ReporteSupervisor::create([
                            'id_supervisor' => $usuario_rol->id_usuario_roles,
                            'id_coordinador' => $coordinador->id_cordinador,
                            'id_sucursal' => request('id_sucursal'),
                            'nombre_reporte' => request('nombre_reporte'),
                            'foto' => $url_img,
                            'estado_corregido' => 1,
                            'observaciones' => request('observaciones'),
                            'estado_listar' => 1,
                        ]);

                        if($reporte){
                            if($this->logCrearNotificacionesMensaje($reporte->id,  $coordinador->id_cordinador, request('nombre_reporte'), $supervisor->nombre." ".$supervisor->apellido, 3)){
                                return response()->json(['message' => 'Reporte realizado con exito'], 200);
                            }else{
                                return response()->json(['message' => 'Error al generar la notificacion']);
                            } 
                        }
                        
                    }
                    return response()->json(['message' => 'Error al carar la imagen'], 400);

                }else{
                    $reporte = ReporteSupervisor::create([
                        'id_supervisor' => $usuario_rol->id_usuario_roles,
                        'id_coordinador' => $coordinador->id_cordinador,
                        'id_sucursal' => request('id_sucursal'),
                        'nombre_reporte' => request('nombre_reporte'),
                        'estado_corregido' => 1,
                        'observaciones' => request('observaciones'),
                        'estado_listar' => 1,
                    ]);

                    if($reporte){
                        if($this->logCrearNotificacionesMensaje($reporte->id,  $coordinador->id_cordinador, request('nombre_reporte'), $supervisor->nombre." ".$supervisor->apellido, 3)){
                            return response()->json(['message' => 'Mensaje enviado'], 200);                    
                        }else{
                            return response()->json(['message' => 'Error al generar la notificacion']);
                        } 
                    }
                }

               
            }else if($gerente && $gerente->id_rol == 4){
                $foto = 'imagen_reporte' . time();
                 
                $url_img = str_replace(" ", "_",'reportes/'.request('nombre_sucursal').'/'.request('nombre_reporte').'/'.$foto);

                 if (request('foto') != "") { // storing image in storage/app/public Folder
                    if(strpos(request('foto'), 'supervisores_api/storage/app/public/img/') == false ){
                        Storage::disk('public')->put('img/'.$url_img, base64_decode(request('foto')));
                        $reporte = ReporteSupervisor::create([
                            'id_supervisor' => $gerente->id_usuario_roles,
                            'id_coordinador' => $coordinador->id_cordinador,
                            'id_sucursal' => request('id_sucursal'),
                            'nombre_reporte' => request('nombre_reporte'),
                            'foto' => $url_img,
                            'observaciones' => request('observaciones'),
                            'estado_corregido' => 0,
                            'estado_listar' => 1,
                        ]);
                        if($reporte){
                            if($this->logCrearNotificacionesMensaje($reporte->id,  $coordinador->id_cordinador, request('nombre_reporte'), $supervisor->nombre." ".$supervisor->apellido, 3)){
                                return response()->json(['message' => 'Reporte realizado con exito'], 200);
                            }else{
                                return response()->json(['message' => 'Error al generar la notificacion']);
                            } 
                        }
                    }
                    return response()->json(['message' => 'Error al carar la imagen'], 400);

                }else{
                    $reporte = ReporteSupervisor::create([
                        'id_supervisor' => $usuario_rol->id_usuario_roles,
                        'id_coordinador' => $coordinador->id_cordinador,
                        'id_sucursal' => request('id_sucursal'),
                        'nombre_reporte' => request('nombre_reporte'),
                        'estado_corregido' => 1,
                        'observaciones' => request('observaciones'),
                        'estado_listar' => 1,
                    ]);
                    if($reporte){
                        if($this->logCrearNotificacionesMensaje($reporte->id,  $coordinador->id_cordinador, request('nombre_reporte'), $supervisor->nombre." ".$supervisor->apellido, 3)){
                            return response()->json(['message' => 'Reporte realizado con exito'], 200);
                        }else{
                            return response()->json(['message' => 'Error al generar la notificacion']);
                        } 
                    }
                }
            }else{
                return response()->json(['message' => 'No tienes permiso para acceder a esta ruta'], 400);
            }
            
        }
    }

    public function detalleReporteSucursal(Request $request)
    {
        $validator=\Validator::make($request->all(),[
            'id_reporte' => 'required',
        ]);
        if($validator->fails())
        {
          return response()->json( ['message' => $validator->errors()->all()],400);
        }

        else
        {
            //Se recupera los datos del usuario que se ha autenticado
            $user=DB::table('users as u')->where('u.id','=',Auth::id())->first();
            $coordinador = DB::table('coordinadores')
            ->where('correo','=',$user->email)->first();

            $supervisor = DB::table('usuario')
            ->where('correo','=',$user->email)->first();

            if($supervisor){
                $usuario_rol=DB::table('usuarios_roles')
                ->where('id_usuario','=',$supervisor->id_usuario)->first();
            }else{
                $usuario_rol = 0;
            }

            if($coordinador){
                $reporte = DB::table('reportes_supervisor as rs')
                ->select('us.nombre', 'us.apellido', 'su.nombre as nombre_sucursal', 'su.cod_sucursal', 'rs.nombre_reporte', 'rs.observaciones', 'rs.foto', 'rs.estado_corregido', 'rs.id as id_reporte')
                ->join('usuario as us', 'rs.id_supervisor', 'us.id_usuario')
                ->join('sucursales as su', 'rs.id_sucursal', 'su.id_suscursal')
                ->where('rs.id', request('id_reporte'))
                ->where('rs.id_coordinador', $coordinador->id_cordinador)
                ->first();
                
                $mensajes = DB::table('mensaje_reporte as mr')
                ->where('mr.id_reporte', request('id_reporte'))
                ->get();
                if($reporte){
                    return response()->json(['detalle' => $reporte, 'mensajes' => $mensajes], 200);
                }else{
                    return response()->json(['message' => 'Reporte no encontado o no pertenece a sus sucursales'], 400);
                }
                
            }else if($usuario_rol){
                $reporte = DB::table('reportes_supervisor as rs')
                ->select('usu.nombre', 'usu.apellido', 'su.nombre as nombre_sucursal', 'su.cod_sucursal', 'rs.nombre_reporte', 'rs.observaciones', 'rs.foto', 'rs.estado_corregido', 'rs.id as id_reporte')
                ->join('usuarios_roles as us', 'rs.id_supervisor', 'us.id_usuario_roles')
                ->join('usuario as usu', 'us.id_usuario', 'usu.id_usuario')
                ->join('sucursales as su', 'rs.id_sucursal', 'su.id_suscursal')
                ->where('rs.id', request('id_reporte'))
                ->where('rs.id_supervisor', $usuario_rol->id_usuario_roles)
                ->first();
                
                $mensajes = DB::table('mensaje_reporte as mr')
                ->where('mr.id_reporte', request('id_reporte'))
                ->get();
                if($reporte){
                    return response()->json(['detalle' => $reporte, 'mensajes' => $mensajes], 200);
                }else{
                    return response()->json(['message' => 'Reporte no encontado o no pertenece a sus sucursales'], 400);
                }
            
            }else{
                return response()->json(['message' => 'Usuario no encontrado'], 400);
            }
 
        }
            
        
    }

    public function crearMensageReporte(Request $request)
    {
        $validator=\Validator::make($request->all(),[
            'id_reporte' => 'required',
            'mensaje' => 'required',
        ]);
        if($validator->fails())
        {
          return response()->json( ['message' => $validator->errors()->all()],400);
        }
        else
        {
            //Se recupera los datos del usuario que se ha autenticado
            $user=DB::table('users as u')->where('u.id','=',Auth::id())->first();

            $coordinador = DB::table('coordinadores')
            ->where('correo','=',$user->email)->first();

            $supervisor = DB::table('usuario')
            ->where('correo','=',$user->email)->first();

            if($coordinador){
                $permisoCoordinador = DB::table('reportes_supervisor')
                ->where('id_coordinador', $coordinador->id_cordinador)
                ->where('id', request('id_reporte'))
                ->first();
            }


            if($supervisor){
                $usuario_rol=DB::table('usuarios_roles')
                ->where('id_usuario','=',$supervisor->id_usuario)->first();
                if($usuario_rol){
                    $permiso = DB::table('reportes_supervisor')
                    ->where('id_supervisor', $usuario_rol->id_usuario_roles)
                    ->where('id', request('id_reporte'))
                    ->first();
                } 
            }

            if($coordinador){
                $reporteMensaje = MensajeReporte::create([
                    'id_reporte' => request('id_reporte'),
                    'nombre_usuario' => $coordinador->nombre." ".$coordinador->apellido,
                    'tipo_usuario' => 1,
                    'mensaje' => request('mensaje'),
                ]);
                
                if($reporteMensaje){
                    if($this->logCrearNotificacionesMensaje(request('id_reporte'), $coordinador->id_cordinador, $permisoCoordinador->nombre_reporte, $coordinador->nombre. " " . $coordinador->apellido, 2)){
                        return response()->json(['message' => 'Mensaje enviado'], 200);                    
                    }else{
                        return response()->json(['message' => 'Error al generar la notificacion']);
                    }
                }else{
                    return response()->json(['message' => 'Error al crear el mensaje'], 400);                    
                }
            }else if($permiso){
                $reporteMensaje = MensajeReporte::create([
                    'id_reporte' => request('id_reporte'),
                    'nombre_usuario' => $supervisor->nombre." ".$supervisor->apellido,
                    'tipo_usuario' => 2,
                    'mensaje' => request('mensaje'),
                ]);
                if($reporteMensaje){
                    if($this->logCrearNotificacionesMensaje(request('id_reporte'), $permiso->id_coordinador, $permiso->nombre_reporte, $supervisor->nombre." ".$supervisor->apellido,2)){
                        return response()->json(['message' => 'Mensaje enviado'], 200);                    
                    }else{
                        return response()->json(['message' => 'Error al generar la notificacion']);
                    }                
                }else{
                    return response()->json(['message' => 'Error al enviar el mensaje'], 400);                    
                }
            }else{
                return response()->json(['message' => 'Tipo de usuario no valido o el reporte no es tuyo'], 400);
            }
 
        }
            
        
    }

    

    public function generarReporeteCoordinador(Request $request)
    {
        $user=DB::table('users as u')->where('u.id','=',Auth::id())->first();
        $coordinador=DB::table('coordinadores')->where('correo','=',$user->email)->first();

        if($coordinador){
            $reporte = DB::table('reportes_supervisor as rs')
            ->select('usu.nombre', 'usu.apellido', 'su.nombre as nombre_sucursal', 'su.cod_sucursal', 'rs.nombre_reporte', 'rs.observaciones', 'rs.foto', 'rs.estado_corregido', 'rs.id as id_reporte')
            ->join('usuarios_roles as us', 'rs.id_supervisor', 'us.id_usuario')
            ->join('usuario as usu', 'us.id_usuario', 'usu.id_usuario')
            ->join('sucursales as su', 'rs.id_sucursal', 'su.id_suscursal')
            ->where('rs.id_coordinador', $coordinador->id_cordinador)
            ->get();

            return response()->json($reporte, 200);
        }else{
            return response()->json('Coordinador no existe', 400);
        }
    }

    public function generarReporeteSupervisor(Request $request)
    {
        $user=DB::table('users as u')->where('u.id','=',Auth::id())->first();
        $supervisor=DB::table('usuario')->where('correo','=',$user->email)->first();

        $usuario_rol=DB::table('usuarios_roles')
        ->where('id_usuario','=',$supervisor->id_usuario)->first();

        if($usuario_rol){
            $reporte = DB::table('reportes_supervisor as rs')
            ->select('us.nombre', 'us.apellido', 'su.nombre as nombre_sucursal', 'su.cod_sucursal', 'rs.nombre_reporte', 'rs.observaciones', 'rs.foto', 'rs.estado_corregido', 'rs.id as id_reporte')
            ->join('usuario as us', 'rs.id_supervisor', 'us.id_usuario')
            ->join('sucursales as su', 'rs.id_sucursal', 'su.id_suscursal')
            ->where('rs.id_supervisor', $usuario_rol->id_usuario)
            ->where('rs.estado_listar', 1)
            ->get();

            return response()->json($reporte, 200);
        }else{
            return response()->json('Supervisor no existe', 400);
        }
    }

    public function porcentajeActividades(Request $request)
    {
        //Se recupera los datos del usuario que se ha autenticado
       $user=DB::table('users as u')->where('u.id','=',Auth::id())->first();

       //obtener los datos del usuario supervisor
       $user_supervisor=DB::table('usuario as u')
       ->select('u.id_usuario', 'u.nombre', 'u.apellido', 'u.cedula', 'u.correo', 'u.telefono', 'u.codigo', 'u.foto')
       ->where('u.correo','=',$user->email)->first();

        //obtener el id del rol del usuario
       $usuario_rol = DB::table('usuarios_roles as ur')
       ->where('ur.id_usuario',$user_supervisor->id_usuario)
       ->first();

        //obtener las actividades segun su plan de trabajo
       $actividades=DB::table('plan_trabajo_asignacion as p')
       ->join('actividades as ac','p.id_plan_trabajo','ac.id_plan_trabajo')
       ->join('sucursales as su','p.id_sucursal','su.id_suscursal')
       ->where('p.id_supervisor',$usuario_rol->id_usuario_roles)
       ->where('p.estado',1)
       ->orderBy('p.id_sucursal', 'desc')
       ->get();

        $porcentaje_sucursal_array = array();
        $porcentajes_generales_array = array();
        $porcentajes_generales_array['actividades_activas'] = 0;
        $porcentajes_generales_array['actividades_completas'] = 0;
        $porcentajes_generales_array['actividades_noRealizadas'] = 0;
        $porcentajes_generales_array['todas_las_actividades'] = 0;
       //bucle que itera las actividades y las obtiene segun la fecha
       foreach($actividades as $ac){
            $fe = DB::table($ac->nombre_tabla. ' as ac')
            ->get();

            foreach($fe as $fecha){
                if($ac->id_plan_trabajo == $fecha->id_plan_trabajo){
                    
                    if(!isset($porcentaje_sucursal_array[$ac->cod_sucursal]['actividades_activas'])){
                        $porcentaje_sucursal_array[$ac->cod_sucursal]['actividades_activas'] = 0;
                    }
                    if(!isset($porcentaje_sucursal_array[$ac->cod_sucursal]['todas_las_actividades'])){
                        $porcentaje_sucursal_array[$ac->cod_sucursal]['todas_las_actividades'] = 0;
                    }
                    if(!isset($porcentaje_sucursal_array[$ac->cod_sucursal]['actividades_completas'])){
                        $porcentaje_sucursal_array[$ac->cod_sucursal]['actividades_completas'] = 0;
                    }
                    if(!isset($porcentaje_sucursal_array[$ac->cod_sucursal]['actividades_noRealizadas'])){
                        $porcentaje_sucursal_array[$ac->cod_sucursal]['actividades_noRealizadas'] = 0;
                    }
                    if(!isset($porcentaje_sucursal_array[$ac->cod_sucursal]['nombre_sucursal'])){
                        $porcentaje_sucursal_array[$ac->cod_sucursal]['nombre_sucursal'] = $ac->nombre;
                    }
                    
                    $porcentajes_generales_array['todas_las_actividades'] += 1;
                    $porcentaje_sucursal_array[$ac->cod_sucursal]['todas_las_actividades']++;
                    switch ($fecha->estado) {
                        case 'Activo':
                        $porcentajes_generales_array['actividades_activas'] += 1;
                        $porcentaje_sucursal_array[$ac->cod_sucursal]['actividades_activas'] ++;
                        break;
                        
                        case 'completo':
                        $porcentajes_generales_array['actividades_completas'] += 1;
                        $porcentaje_sucursal_array[$ac->cod_sucursal]['actividades_completas'] ++;
                        break;
                        
                        case 'noReaizada':
                        $porcentajes_generales_array['actividades_noRealizadas'] += 1;
                        $porcentaje_sucursal_array[$ac->cod_sucursal]['actividades_noRealizadas'] ++;
                        break;
                        
                        default:
                            return response()->json('Estad no definido o no validado', 400);
                        break;
                    }
                }
                
            }
            
        }
            return response()->json(['porcentaje_general' => $porcentajes_generales_array, 'porcentaje_sucursal' => $porcentaje_sucursal_array], 200);
            
    }

    public function corregirReporte(Request $request)
    {
        $validator=\Validator::make($request->all(),[
            'id_reporte' => 'required',
        ]);
        if($validator->fails())
        {
          return response()->json( ['message' => $validator->errors()->all()],400);
        }

        else
        {
            //Se recupera los datos del usuario que se ha autenticado
            $user=DB::table('users as u')->where('u.id','=',Auth::id())->first();
            $coordinador = DB::table('coordinadores')
            ->where('correo','=',$user->email)->first();

            if($coordinador){
                $reporte = DB::table('reportes_supervisor as rs')
                ->where('rs.id', request('id_reporte'))
                ->where('rs.id_coordinador', $coordinador->id_cordinador)
                ->update(['estado_corregido' => 2]);
                
                if($reporte){
                    return response()->json(['message' => $reporte], 200);
                }else{
                    return response()->json(['message' => 'Reporte no encontado o no pertenece a sus sucursales'], 400);
                }
                
            }else{
                return response()->json(['message' => 'Usuario no encontrado'], 400);
            }
 
        }
    }

}
