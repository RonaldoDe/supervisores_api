<?php

namespace App\Http\Controllers\Api\Auth\Coordinador;

use Illuminate\Http\Request;
use Laravel\Passport\Client;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Modelos\Usuario;
use App\Modelos\Usuario_roles;


class HomeCoordinadorController extends Controller
{


    public function index(Request $request)
    {



        if($this->rutear(Auth::id())=="coordinador")
        {
                  /*Author jhonatan cudris */


    //se valida que todas las peticiones entrantes al servidor solo funcionen via ajax de lo contrario saldra un error.

    //if(!$request->ajax()){return redirect('/');}

       //Se recupera los datos del usuario que se ha autenticado
       $user=DB::table('users as u')->where('u.id','=',Auth::id())->first();

       // Se recupera los datos del coordinador para mostrar su region y datos personales
       $region=DB::table('region as r')
                        ->join('coordinadores as c','c.id_cordinador','=','r.id_cordinador')
                        ->select('r.id_region','r.nombre as region','c.apellido','c.nombre','r.id_cordinador')
                        ->where('c.correo','=',$user->email)
                        ->first();


      // Se recupera los datos de las zonas asociados a la region del coordinador autenticado
    $zonas=DB::table('zona as z')
                ->join('region as r','r.id_region','=','z.id_region')
                ->join('usuarios_roles as u','u.id_usuario_roles','=','z.id_usuario_roles')
                ->join('roles as ro','ro.id_roles','=','u.id_rol')
                ->join('usuario as us','us.id_usuario','=','u.id_usuario')
                ->join('coordinadores as c','c.id_cordinador','=','r.id_cordinador')
                //->join('sucursales as s','s.id_zona','=','z.id_zona')
                ->where('r.id_cordinador','=',$region->id_cordinador)
                ->select('z.descripcion_zona','z.id_zona','us.nombre as supervisor','z.id_usuario_roles as id_usuario_supervisor',
                DB::raw("concat(us.nombre,' ',us.apellido) as supervisor"))
                ->get();


       //se retorna por ajax la region y zonas como objetos de las consultas realizadas
     return response()->json(["region"=>$region,"Zonas"=>$zonas]);

        }
        else
        {

            return response()->json("error",401);
        }


    }

    public function CrearSupervisores(Request $request){

//if(!$request->ajax()){return redirect('/');}
        //funcion que crea los usuarios

//validando que el usuario sea un administardor
        if($this->rutear(Auth::id())=="coordinador")
        {
            $validator=\Validator::make($request->all(),[
                'name' => 'required',
                'email' => 'required|email|unique:users,email',

                'password' => 'required|min:6',
                'apellido'=>'required',
                'cedula'=>'required|unique:usuario,cedula',
                'telefono'=>'required',

            ]);


            if($validator->fails())
            {


              return response()->json( $errors=$validator->errors()->all() );
            }

            else
            {
                try{

                    //instancia del modelo user para crear una instancia del mismo modelo con sus valores
                    //metodo begin que permite la doble insercion
                    DB::beginTransaction();
                    $user = User::create([
                        'name' => request('name'),
                        'email' => request('email'),

                      'password' => bcrypt(request('password'))
                    ]);


                    $usuario =Usuario::create([

                        'nombre' =>request('name'),
                        'apellido' =>request('apellido'),
                        'cedula' =>request('cedula'),
                        'correo' =>request('email'),
                        'password'=>request('password'),
                        'telefono'=>request('telefono')
                    ]);



                    $usuario_roles =Usuario_roles::create([

                        'id_rol' =>'1',
                        'id_usuario' =>$usuario->id_usuario,
                        'estado'=>'0'
                    ]);


                    DB::commit();

                    return response()->json(["succes"=>" registro creado"]);

                }
                catch(Exeption $e){

                    DB::rollBack();

                }


             }
        }
            else{

                return response()->json("error",401);
            }



    }

    public function mostrarPuntosVentasIdZona(Request $request, $id){
/*Author jhonatan cudris */
       //function que recibe un parametro que sera el id de la zona y debuelve todos los puntos de venta que
       //con su supervisor que tiene asiganado el filtro lo hace por el id de la zona que tienen dichos puntos de venta

        $sucursal=DB::table('sucursales as s')
            ->join('zona as zo','s.id_zona','=','zo.id_zona')
            ->join('usuarios_roles as ur','zo.id_usuario_roles','=','ur.id_usuario_roles')
            ->join('usuario as us','ur.id_usuario','=','us.id_usuario')
            ->where('s.id_zona','=',$id)

            ->select('s.id_suscursal','s.cod_sucursal','s.nombre as sucursal','ur.id_usuario_roles as id_supervisor',
            DB::raw("concat(us.nombre,' ',us.apellido) as supervisor"))
            ->get();
        return response()->json(["sucursal"=>$sucursal]);
    }



    }
