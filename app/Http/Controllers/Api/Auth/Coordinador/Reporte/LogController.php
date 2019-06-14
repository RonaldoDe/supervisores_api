<?php

namespace App\Http\Controllers\Api\Auth\Coordinador\Reporte;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Modelos\Notificaciones;
use Illuminate\Support\Facades\Auth;

class LogController extends Controller
{
    //mostrar notificaciones al coordinador
    public function logNotificaciones()
    {
        
        //obtener datos del coordinador registrado
       $user=DB::table('users as u')->where('u.id','=',Auth::id())->first();
       $coordinador=DB::table('coordinadores')->where('correo','=',$user->email)->first();

       $supervisor=DB::table('usuario')
        ->where('correo','=',$user->email)->first();
        if($supervisor){
            $usuario_rol=DB::table('usuarios_roles')
            ->where('id_usuario','=',$supervisor->id_usuario)->whereIn('id_rol', [1, 5])->first();
            if(!$usuario_rol){
                $admin=DB::table('usuarios_roles')
                ->where('id_usuario','=',$supervisor->id_usuario)
                ->where('id_rol', 2)
                ->first();
            }
        }

       if($coordinador){
            $log = DB::table('notificaciones')
            ->where('id_coordinador', $coordinador->id_cordinador)
            ->orderBy('fecha', 'DESC')
            ->where('tipo_usuario', 2)
            ->paginate(20);
            return response()->json(['message' => $log, 'usuario' => 2],200);

       }else if($usuario_rol){
            $log = DB::table('notificaciones')
            ->where('id_usuario', $usuario_rol->id_usuario_roles)
            ->where('tipo_usuario', 1)
            ->where('tipo', 2)
            ->orderBy('fecha', 'DESC')
            ->paginate(20);
            return response()->json(['message' => $log, 'usuario' => 1],200);

       }else if($admin){
           
            $log = DB::table('notificaciones')
            ->where('tipo_usuario', 2)
            ->orderBy('fecha', 'DESC')
            ->paginate(20);
            return response()->json(['message' => $log, 'usuario' => 3],200);

        }else{
            return response()->json(['message' => 'Usuario no encontrado'],400);
       }

        

    }

    //marcar notificacion como leida
    public function notificacionLeida(Request $request)
    {
         //validacion de los datos de la actividad
         $validator=\Validator::make($request->all(),[
            'id_notificacion' => 'required',
        ]);
        if($validator->fails())
        {
          return response()->json( ['message' => $validator->errors()->all()],400 );
        }

        else
        {
            // actualizar estado de la notificacion
            $leer = Notificaciones::find(request('id_notificacion'));
            if($leer!= null){
                $leer->leido = 1;
                $leer->update();

                return response()->json(['message' => $leer],200);
            }else{
                return response()->json(['message' => 'Notificación no encontrada.'],400);
            }
        }
    }
    //marcar notificacion como no leida
    public function notificacionNoLeida(Request $request)
    {
        $validator=\Validator::make($request->all(),[
            'id_notificacion' => 'required',
        ]);
        if($validator->fails())
        {
          return response()->json( ['message' => $validator->errors()->all()],400 );
        }else{
            // actualizar estado de la notificacion
            $leer = Notificaciones::find(request('id_notificacion'));
            if($leer!= null){
                $leer->leido = 0;
                $leer->update();

                return response()->json(['message' => $leer],200);
            }else{
                return response()->json(['message' => 'Notificación no encontrada.'],400);
            }
        }
    }
}
