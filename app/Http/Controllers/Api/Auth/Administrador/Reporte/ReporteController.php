<?php

namespace App\Http\Controllers\Api\Auth\Administrador\Reporte;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Modelos\Reportes\ReporteSupervisor;
use App\User;

class ReporteController extends Controller
{
    public function generarReporeteAdmin(Request $request)
    {
        $user=DB::table('users as u')->where('u.id','=',Auth::id())->first();

            $reporte = DB::table('reportes_supervisor as rs')
            ->select('usu.nombre', 'usu.apellido', 'rs.nombre_reporte', 'rs.observaciones', 'rs.foto', 'rs.estado_corregido', 'rs.id as id_reporte', 'id_categoria')
            ->join('usuarios_roles as us', 'rs.id_supervisor', 'us.id_usuario_roles')
            ->join('usuario as usu', 'us.id_usuario', 'usu.id_usuario')
            ->get();

            return response()->json($reporte, 200);

    }

    public function detalleReporteSucursalAdmin(Request $request)
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


            $reporte = DB::table('reportes_supervisor as rs')
            ->select('rs.id_sucursal', 'us.nombre', 'us.apellido', 'rs.nombre_reporte', 'rs.observaciones', 'rs.foto', 'rs.estado_corregido', 'rs.id as id_reporte', 'id_categoria')
            ->join('usuarios_roles as usr', 'rs.id_supervisor', 'usr.id_usuario_roles')
            ->join('usuario as us', 'usr.id_usuario', 'us.id_usuario')
            ->where('rs.id', request('id_reporte'))
            ->first();
            $mensajes = DB::table('mensaje_reporte as mr')
            ->where('mr.id_reporte', request('id_reporte'))
            ->get();

            if($reporte){
                if($reporte->id_sucursal != ''){
                    $sucursal = DB::table('reportes_supervisor as rs')
                    ->select('su.nombre', 'su.cod_sucursal')
                    ->join('sucursales as su', 'rs.id_sucursal', 'su.id_suscursal')
                    ->where('rs.id', request('id_reporte'))
                    ->first();
                }else{
                    $sucursal = "";
                }
                return response()->json(['detalle' => $reporte, 'mensajes' => $mensajes, 'nombre_sucursal' => $sucursal], 200);
            }else{
                return response()->json(['message' => 'Reporte no encontado o no pertenece a sus sucursales'], 400);
            }
            
                 
        }
            
        
    }

    public function actividadCoordinador(Request $request)
    {
        $validator=\Validator::make($request->all(),[
            'nombre_reporte' => 'required',
            'observaciones' => 'required',
            'categoria' => 'required',
            'id_coordinador' => 'required',
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
            $coordinador = DB::table('coordinadores')->where('id_cordinador', request('id_coordinador'))->first();
            $categoria = DB::table('tipo_reporte')->where('id', request('categoria'))->first();
            if($categoria && $categoria->ancla == 1){
                $reporte = ReporteSupervisor::create([
                    'id_supervisor' => $usuario_rol->id_usuario_roles,
                    'id_coordinador' => request('id_coordinador'),
                    'id_sucursal' => request('id_sucursal'),
                    'nombre_reporte' => request('nombre_reporte'),
                    'observaciones' => request('observaciones'),
                    'estado_corregido' => 1,
                    'id_categoria' => request('categoria'),
                    'estado_listar' => 1,
                ]);
            }else if($categoria && $categoria->ancla == 2){
                $reporte = ReporteSupervisor::create([
                    'id_coordinador' => request('id_coordinador'),
                    'id_supervisor' => $usuario_rol->id_usuario_roles,
                    'id_sucursal' => '',
                    'nombre_reporte' => request('nombre_reporte'),
                    'observaciones' => request('observaciones'),
                    'estado_corregido' => 1,
                    'id_categoria' => request('categoria'),
                    'estado_listar' => 1,
                ]);
            }else{
                return response()->json(['message' => 'categoria no encontrada'],400);
            }
            
            if($reporte){
                if(!request('id_sucursal') != ''){
                    if($this->logCrearNotificacionesMensaje($reporte->id,  request('id_coordinador'), '', request('nombre_reporte'), $supervisor->nombre." ".$supervisor->apellido, 3, 2)){
                        return response()->json(['message' => 'Reporte realizado con exito'], 200);
                    }else{
                        return response()->json(['message' => 'Error al generar la notificacion'],400);
                    } 
                }else{
                    if($this->logCrearNotificacionesMensaje($reporte->id,  request('id_coordinador'), request('id_sucursal'), request('nombre_reporte'), $supervisor->nombre." ".$supervisor->apellido, 3, 2)){
                        return response()->json(['message' => 'Reporte realizado con exito'], 200);
                    }else{
                        return response()->json(['message' => 'Error al generar la notificacion'],400);
                    } 
                }
            }
        }
                    
    }

    public function listBranch(Request $request)
    {
        $user = User::find(Auth::id());
        if($user->id == 68){
            if(request('branch') != ''){
                $name = request('branch');
                $branchs = DB::table('sucursales')
                ->where('nombre', 'LIKE', '%'.$name.'%')
                ->get();
                return response()->json($branchs, 200);
            }else{
                $branchs = DB::table('sucursales')->get();
                return response()->json($branchs, 200);
            }
            
        }else{
            return response()->json('Acceso denegado', 401);
        }
    }

    public function addLocation(Request $request)
    {
        $validator=\Validator::make($request->all(),[
            'id' => 'required',
            'latitud' => 'required',
            'longitud' => 'required',
        ]);
        if($validator->fails())
        {
          return response()->json( ['message' => $validator->errors()->all()],400);
        }

        else
        {
            $user = User::find(Auth::id());
            if($user->id == 68){
                if(request('id') != ''){
                    $branchs = DB::table('sucursales')
                    ->where('id_suscursal', request('id'))
                    ->update(['latitud' => request('latitud'), 'longitud' => request('longitud')]);
                    if($branchs){

                        return response()->json('Localizacion actualizada', 200);
                        
                    }else{
                        return response()->json('Error al actualizar', 400);
                    }
                }
            }else{
                return response()->json('Acceso denegado', 401);
            }
        }
    }
}
