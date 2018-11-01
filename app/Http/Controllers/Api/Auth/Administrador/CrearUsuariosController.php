<?php
namespace App\Http\Controllers\Api\Auth\Administrador;


use Illuminate\Http\Request;
use Laravel\Passport\Client;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Modelos\Usuario;
use App\Modelos\Usuario_roles;
use App\Modelos\Coordinadores;


class CrearUsuariosController extends Controller
{


    public function register(Request $request)
    {
        //if(!$request->ajax()){return redirect('/');}
             $validator=\Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'email_verified_at'=>'required',
            'password' => 'required|min:6',
            'apellido'=>'required',
            'cedula'=>'required|unique:usuario,cedula',
            'telefono'=>'required',
]);

        if($validator->fails())
        {

          //return response()->json(['errors'=>$validator->errors()->all()]);
          // return response()->json( $datos='nO ' );
          return response()->json( $errors=$validator->errors()->all() );
        }

        else
        {
            try{

                $rol=DB::table('roles')->where('id_roles','=', request('tipo_rol'))
                ->whereNotIn('id_roles',[2])
                ->get();

                DB::beginTransaction();

                $user = User::create([
                    'name' => request('name'),
                    'email' => request('email'),
                    'email_verified_at'=>'required',
                  'password' => bcrypt(request('password'))
                ]);



                 if(request('tipo_rol')=='c')
                {
                    $usuario =Coordinadores::create([

                        'nombre' =>request('name'),
                        'apellido' =>request('apellido'),
                        'cedula' =>request('cedula'),
                        'correo' =>request('email'),
                        'password'=>request('password'),
                        'telefono'=>request('telefono')
                    ]);

                }
                else if(count($rol)==0)
                {
                    return response()->json( ['errors'=>'errors'], 401);


                }
                else
                {
                    $usuario =Usuario::create([

                        'nombre' =>request('name'),
                        'apellido' =>request('apellido'),
                        'cedula' =>request('cedula'),
                        'correo' =>request('email'),
                        'password'=>request('password'),
                        'telefono'=>request('telefono')
                    ]);

                    $usuario_roles =Usuario_roles::create([

                        'id_rol' =>request('tipo_rol'),
                        'id_usuario' =>$usuario->id_usuario,
                        'estado'=>'0'
                    ]);


                }



                DB::commit();


            }catch(Exeption $e){

                DB::rollBack();

            }


            }
        }

        public function MostrarRol(Request $request){


            $roles=DB::table('roles as r')
                            ->whereNotIn('id_roles',[1,2])->get();
                             return $roles;

        }



 }
