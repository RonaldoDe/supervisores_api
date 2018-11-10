<?php

namespace App\Http\Controllers\Api\Auth\Coordinador;

use Illuminate\Http\Request;
use Laravel\Passport\Client;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Modelos\Zonas;
use App\Modelos\Usuario_roles;





class ZonasCordinadorController extends Controller
{

/*Author jhonatan cudris */
    public function CrearZonas(Request $request)
    {
//funcion que debuelve el id del cordinador  logueada para mirar la region que tiene asignada y asignaserla
// a la zona que qquiera crear

       $id_region=$this->DevolverIdCordinador();




       //validador para los campos vacios
        $validator=\Validator::make($request->all(),[
            'descripcion_zona' => 'required|unique:zona,descripcion_zona',
            'id_usuario_roles' => 'required',


        ]);


        if($validator->fails())
        {
          return response()->json( $errors=$validator->errors()->all() );
        }

        else
        {
            try{
                 //DB::beginTransaction();

//esta es la variable que almacena  la funcion devolverCordinador en este caso depnde lo que nos retorne
//hara la insercion esta validacion  se hace en caso del cordinador quisiera agregar una zaona
//y no tenga una region asignada

if($id_region == 0) {
 return response()->json(["error"=>"el cordinador no tiene una region asignada"]);

}else{

    $zona = Zonas::create([
        //se creA LA zona con el usuario de tipo supervisor
        'descripcion_zona' => request('descripcion_zona'),
        'id_region' => $id_region,
        'id_usuario_roles' => request('id_usuario_roles'),


    ]);

//cambia el estado del id_usuario roles a 1 que sera asiganado ya que este usario
//ha sido selecionado para una zona


$update_user_roles= Usuario_roles::findOrFail($zona->id_usuario_roles);
$update_user_roles->estado='1';
$update_user_roles->update();


    return response()->json(["succes"=>" registro creado"]);
    }

}
catch(Exeption $e){

    return response()->json($e);

}


}


    }


    public function DevolverUsuariosSupervisores(){
        //funcion que debuelve los usuarios tipo supervisores que no estan asignados a una zona
        //para crear una zona en especifica
        $user=DB::table('usuarios_roles as ur')
        ->join('usuario as us','ur.id_usuario','=','us.id_usuario')
        ->where('ur.id_rol','=', 1)
        ->where('ur.estado','=', 0)
        ->select('ur.id_usuario_roles', 'us.nombre', 'us.apellido')->get();


        return $user;

    }

    //funcion que valida si el cordinador logueado tiene alguna region asignada para agregarsela
    // a su zona en caos de qu no tenga ninguna region asignada le devolvera que no tiene
    public function DevolverIdCordinador(){

        $user=DB::table('users as u')->where('u.id','=',Auth::id())->first();

        //Obtener el correo de el usuario que se encuentra logueado
        $coordinador=DB::table('coordinadores as c')
        ->select('c.id_cordinador')
        ->where('c.correo','=', $user->email)
        ->first();

        $region=DB::table('region as re')
        ->select('re.id_region')
        ->where('re.id_cordinador','=',$coordinador->id_cordinador)
         ->first();

//en caso deque la consuylata nos devulevq null ya que puede ser qe el cordinador logueado en el momento
//no tenaga asiganado una region  con esta funcion validamos ese error

     if($region == null){

        return $tiene=0;


     }else{
        $tiene=1;
        return $region->id_region;

     }


    }


}
