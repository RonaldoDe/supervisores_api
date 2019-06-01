<?php

namespace App\Http\Controllers\Api\Auth\Supervisores;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Http\Controllers\Helper\SenderEmail;
use App\Http\Controllers\Helper\TemplateEmail;

class PasswordUpdateController extends Controller
{

    //actualizacion de contraseña
    public function passwordUpdate(Request $request)
    {
        //validacion de los datos del cambio de contraseña
        $validator=\Validator::make($request->all(),[
            'email' => 'required|email',
        ]);
        if($validator->fails())
        {
          return response()->json( $errors=$validator->errors()->all(),400 );
        }

        else
        {
            //buscar usuario por su email
            $user = User::where('email', request('email'))->first();
            if($user != null){
                //codigo random de 1 digitos para validar el correo
                $codigo = random_int(0, 9999);
                //enviar correo 
                // $mail = Mail::send('emails.update_password', ['codigo' => $codigo], function($message) use($request){
                //     $message->to(request('email'))
                //             ->subject('Por favor confirma el cambio de contraseña');
                // });
                $send_email = SenderEmail::sendEmail(request('email'), 'Por favor confirma el cambio de contraseña', $user->nombre, TemplateEmail::resetPassword($codigo));
                if($send_email == 1){
                    //validar que el usuario tenga el codigo    
                    $validate_code = DB::table('users')->where('code_confirmation', $codigo)->first();
                    while($validate_code){
                    $codigo = random_int(0, 9999);
                        $validate_code = DB::table('users')->where('code_confirmation', $codigo)->first();
                    }
                    $user->code_confirmation = $codigo;
                    $user->email_verified_at = true;
                    $user->update();
                    return response()->json('Correo de cambio de contraseña enviado.', 200);
                }else{
                    return response()->json($send_email, 400);
                }
            }else{
                return response()->json('Usuario no encontrado.', 400);
            }
        }
    }

 
//verificar los datos y actualizar cotraseña
    public function verify(Request $request)
    {
        //validacion de los datos de la actividad
        $validator=\Validator::make($request->all(),[
            'email' => 'required|email',
            'codigo' => 'required',
            'password' => 'required|min:6',
        ]);
        if($validator->fails())
        {
          return response()->json( $errors=$validator->errors()->all(),400);
        }

        else
        {   
            //validar que el codigo sea el mismo y actualizar
            $user = User::where('email_verified_at', true)
            ->where('code_confirmation', request('codigo'))
            ->where('email', request('email'))
            ->first();
            if($user != null){
                $user->code_confirmation=null;
                $user->email_verified_at = false;
                $user->password = bcrypt(request('password'));
                $user->update();
                return response()->json('Contraseña Cambiada con exito',200);
            }else{
                return response()->json('El código no es valido o ya fue usuado.',400);

            }
            
        }
    }
}
