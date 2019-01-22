<?php

namespace App\Http\Controllers\Api\Auth\Coordinador\Reporte;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Modelos\Notificaciones;
use Illuminate\Support\Facades\Auth;

class LogController extends Controller
{
    public function logNotificaciones()
    {
        
        //obtener datos del coordinador registrado
       $user=DB::table('users as u')->where('u.id','=',Auth::id())->first();
       $coordinador=DB::table('coordinadores')->where('correo','=',$user->email)->first();

        $log = DB::table('notificaciones')
        ->orderBy('fecha', 'DESC')
        ->take(100)
        ->get();

        return response()->json(['message' => $log],200);
    }

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

    public function notificacionNoLeida(Request $request)
    {
        $validator=\Validator::make($request->all(),[
            'id_notificacion' => 'required',
        ]);
        if($validator->fails())
        {
          return response()->json( ['message' => $validator->errors()->all()],400 );
        }else{
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
