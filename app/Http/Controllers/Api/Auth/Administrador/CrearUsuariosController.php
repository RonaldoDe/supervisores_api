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
use App\Modelos\Region;
/*Author jhonatan cudris */

//controlador que hace instancia de la modelo user y usuario para crear los usuarios  del sistema
//controlador dirigido al Administardor

class CrearUsuariosController extends Controller
{




//funcion que crea los usuarios -> Administrador
    public function register(Request $request)
    {
        //if(!$request->ajax()){return redirect('/');}
        //funcion que crea os usuarios
             $validator=\Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users,email',

            'password' => 'required|min:6',
            'apellido'=>'required',
            'cedula'=>'required|unique:usuario,cedula',
            'telefono'=>'required',
            'tipo_rol'=>'required'
]);

        if($validator->fails())
        {


          return response()->json( $errors=$validator->errors()->all() );
        }

        else
        {
            try{

                //try que captura las exepciones

//instancia de la tabla roles que me debuelve todo los roles menos el de administardor  para asignarle a un usuario su rol
//


                //transacion pra hacer una doble insercion tanto en la tabla user como usuario
                DB::beginTransaction();

                //instancia del modelo user para crear una instancia del mismo modelo con sus valores
                $user = User::create([
                    'name' => request('name'),
                    'email' => request('email'),

                  'password' => bcrypt(request('password'))
                ]);


//validacion del tipo de ususario que se crea si es cordinador o supervisor
                 if(request('tipo_rol')=='c')
                {//si el tipo rl que no devuelbe es C el value del input list crear un usuario tipo cordinador
                    $usuario =Coordinadores::create([
                        //instancia del modelo de la tabla coordinadores para crear un objeto del mismo
                        'nombre' =>request('name'),
                        'apellido' =>request('apellido'),
                        'cedula' =>request('cedula'),
                        'correo' =>request('email'),
                        'password'=>request('password'),
                        'telefono'=>request('telefono'),
                        'asignado'=>0,
                    ]);

                }
                else if(count($rol)==0)
                {//validacion en caso del que no selecione el tipo de rol al usuario
                    return response()->json( ['errors'=>'errors'], 401);


                }
                else
                {//en caso de que el rol debuelto no sea c(cordinador ) o no halla un error por defecto, instanciara
                    //el modelo de la tabla usuario y creara un recurso o objeto del mismo
                    $usuario =Usuario::create([

                        'nombre' =>request('name'),
                        'apellido' =>request('apellido'),
                        'cedula' =>request('cedula'),
                        'correo' =>request('email'),
                        'password'=>request('password'),
                        'telefono'=>request('telefono')
                    ]);
//modelo de la tabla usuarios_roles que nospermite crear el registro en dicha tablaon el id del usuarioy el roll que tiene el mismo
//para poder controlar las rutas y os permisos que el mismo va  a tener
                    $usuario_roles =Usuario_roles::create([

                        'id_rol' =>request('tipo_rol'),
                        'id_usuario' =>$usuario->id_usuario,
                        'estado'=>0
                    ]);


                }


//commit para ejecuatar la sentencia que nos debuelba el request
                DB::commit();

                return response()->json(["succes"=>" Usuario Creado"]);


            }catch(Exeption $e){

                DB::rollBack();

            }


            }
        }

        public function MostrarRol(Request $request){

//funcion que nos debuelve el modelo de la tabla roles para asignarl un roll al usuario creado que sea diferente del cordinador
            $roles=DB::table('roles as r')
                            ->whereNotIn('id_roles',[2])
                            ->select('id_roles','nombre_rol')->get();
                             return response()->json($roles);

        }


        //funcion  para crear una region y asignarla a un  cordiandor en especifico
        public function crearRegion(Request $request){

            $validator=\Validator::make($request->all(),[
                'id_cordinador' => 'required',
                'nombre' => 'required|unique:region,nombre',



            ]);


            if($validator->fails())
        {
          return response()->json( $errors=$validator->errors()->all() );
        }

        else
        {
            $crear_region =Region::create([

                'id_cordinador' =>request('id_cordinador'),
                'nombre' =>request('nombre'),
                'descripcion'=>request('descripcion'),
            ]);

        }

        }

        //funcion que debuelve los cordinadores que no han sido  asignado y tienen un esatdo de 0
        public function devolverCordinadorNoAsigando(){

        $coordinadores =DB::table('coordinadores')
        ->where('asignado','=',0)
        ->select('id_cordinador','cedula',DB::raw("concat(nombre,' ',apellido) as cordinador"))->get();

        return response()->json(["coordinadores"=>$coordinadores]);

        }



 }
