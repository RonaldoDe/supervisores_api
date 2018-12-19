<?php

namespace App\Http\Controllers\Api\Auth\Supervisores;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;
use Illuminate\Support\Facades\DB;
use App\User;
class PasswordUpdateController extends Controller
{
    public function passwordUpdate(Request $request)
    {
        
        $user = User::where('email', request('email'))->first();
        if($user != null){
            $codigo = str_random(25);
            $mail = Mail::send('emails.update_password', ['codigo' => $codigo], function($message) use($request){
                $message->to(request('email'))
                        ->subject('Por favor confima el cambio de contraseña');
            });
            $user->estado = $codigo;
            $user->email_verified_at = true;
            $user->update();
            return response()->json('Correo enviado', 200);
        }else{
            return response()->json('Usuario no enconrado', 202);
        }
        
    }

 

    public function verify(Request $request)
    {
        $user = User::where('email_verified_at', true)
        ->where('estado', request('codigo'))
        ->first();
        if($user != null){
            $user->estado=null;
            $user->email_verified_at = false;
            $user->password = request('password');
            $user->update();
            return response()->json('Contraseña Cambiada con exito',200);
        }else{
            return response()->json('Credenciales incorrerctas',401);

        }
        
    }
}
