<?php

namespace App\Http\Controllers\Api\Auth\Log;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modelos\Log\LogError;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LogErrorsController extends Controller
{

    //simple funcion que almacena los errores generados en el app movil y web
    public function logErrors(Request $request)
    {
        $validator=\Validator::make($request->all(),[
            'header' => 'required',
            'body' => 'required',
            'tipo_usuario' => 'required',
        ]);
        if($validator->fails())
        {
          return response()->json( ['message' => $validator->errors()->all()],400 );
        }

        else
        {
            if(request('tipo_usuario') == 1){
                $user = DB::table('users')->where('id', Auth::id())->first();
                $supervisor = DB::table('usuario')->where('correo', $user->email)->first();

                if($supervisor){
                    $log = LogError::create([
                        'header' => request('header'),
                        'body' => request('body'),
                        'id_usuario' =>  $supervisor->id_usuario,
                        'tipo_usuario' =>  1,
                    ]);

                    if($log){
                        return response()->json('Pronto resolveremos el error', 200);                        
                    }else{
                        return response()->json('Error de logica', 400);                        
                    }
                }else{
                    return response()->json('Usuario supervisor no encontrado', 400);                        

                }
            }else if(request('tipo_usuario') == 2){
                $user = DB::table('users')->where('id', Auth::id())->first();
                $coordinador = DB::table('coordinadores')->where('correo', $user->email)->first();

                if($coordinador){
                    $log = LogError::create([
                        'header' => request('header'),
                        'body' => request('body'),
                        'id_usuario' =>  $coordinador->id_cordinador,
                        'tipo_usuario' =>  2,
                    ]);

                    if($log){
                        return response()->json('Pronto resolveremos el error', 200);                        
                    }else{
                        return response()->json('Error de logica', 400);                        
                    }
                }else{
                    return response()->json('Usuario coordinador no encontrado', 400);                        

                }

            }else{
                return response()->json('Tipo de usuario no valido', 400);
            }
        }
    }
}
