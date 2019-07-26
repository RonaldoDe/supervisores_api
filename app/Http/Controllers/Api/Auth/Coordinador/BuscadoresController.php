<?php

namespace App\Http\Controllers\Api\Auth\Coordinador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BuscadoresController extends Controller
{
    //buscador de productos
    public function searchProducts(Request $request)
    {
        $validator=\Validator::make($request->all(),[
            'nombre_producto' => 'required',
        ]);

        if($validator->fails())
        {
          return response()->json( $errors=$validator->errors()->all(),400 );
        }

        else
        {
            //nombre del producto
            $producto=request('nombre_producto');
            //validar si tiene un laboratorio en request si lo tiene hacer el filtro por el mismo
            if(request('laboratorio') == ''){
                $productos = DB::table('productos')
                ->select('codigo', 'nombre_comercial', 'laboratorio_id')
                ->orderBy('nombre_comercial', 'ASC')
                ->where('nombre_comercial', 'LIKE', '%'.$producto.'%')
                ->paginate(10);
            }else{
                $productos = DB::table('productos')
                ->select('codigo', 'nombre_comercial', 'laboratorio_id')
                ->orderBy('nombre_comercial', 'ASC')
                ->where('nombre_comercial', 'LIKE', '%'.$producto.'%')
                ->where('laboratorio_id', request('laboratorio'))
                ->paginate(10);
            }

            return response()->json(["productos"=>$productos],200);
        }
    }

    //buscar laboratorios
    public function searchLaboratories(Request $request)
    {
        $validator=\Validator::make($request->all(),[
            'laboratorio' => 'required',
        ]);

        if($validator->fails())
        {
          return response()->json( $errors=$validator->errors()->all(),400 );
        }

        else
        {
            //obtener el laboratorio y buscar
            $laboratorio=request('laboratorio');
            $laboratorios = DB::table('laboratorio')
            ->select('dk', 'nombre')
            ->orderBy('nombre', 'ASC')
            ->where('nombre', 'LIKE', '%'.$laboratorio.'%')
            ->paginate(10);

            return response()->json(["laboratorios"=>$laboratorios],200);
        }
    }

    //buscar sucursales por supervisor
    public function searchSucursales(Request $request)
    {
        $validator=\Validator::make($request->all(),[
            'nombre_sucursal' => 'required',
        ]);

        if($validator->fails())
        {
          return response()->json( $errors=$validator->errors()->all(),400 );
        }

        else
        {
            //obtener el usuario logueado
            $user=DB::table('users as u')->where('u.id','=',Auth::id())->first();
            //obtener el supervisor
            $supervisor=DB::table('usuario')
            ->where('correo','=',$user->email)->first();
            //obtener el usuario tipo spervisor
            $usuario_rol=DB::table('usuarios_roles')
            ->where('id_usuario','=',$supervisor->id_usuario)->first();
            //obtener el usuario con su zona
            $zona = DB::table('usuario_zona')
            ->where('id_usuario','=',$usuario_rol->id_usuario_roles)->first();
            //si tiene zona filtrar por la misma
            if($zona){
                $nombre_sucursal = request('nombre_sucursal');
                $sucursales = DB::table('sucursales')
                ->select('id_suscursal', 'cod_sucursal', 'nombre')
                ->orderBy('nombre', 'ASC')
                ->where('nombre', 'LIKE', '%'.$nombre_sucursal.'%')
                ->where('id_zona',$zona->id_zona)
                ->paginate(10);
            }else{
                $nombre_sucursal = request('nombre_sucursal');
                $sucursales = DB::table('sucursales')
                ->select('id_suscursal', 'cod_sucursal', 'nombre')
                ->orderBy('nombre', 'ASC')
                ->where('nombre', 'LIKE', '%'.$nombre_sucursal.'%')
                ->paginate(10);
            }

            return response()->json(["sucursales"=>$sucursales],200);
        }
    }
    // buscar empleados de una sucursal
    public function empleados_sucursal(Request $request)
    {
        //id de la sucursal
        $validator=\Validator::make($request->all(),[
            'id_sucursal' => 'required',
        ]);

        if($validator->fails())
        {
          return response()->json( $errors=$validator->errors()->all(),400 );
        }

        else
        {

            //buscar empleados de una sucursal
            $empleados = DB::table('empleados_sucursal')
            ->select('dk_empleado','nombre', 'apellido', 'cargo')
            ->orderBy('cargo', 'ASC')
            ->where('nombre', 'LIKE', '%'.request('nombre').'%')
            ->where('id_sucursal',request('id_sucursal'))
            ->where('id_estado',1)
            ->paginate(10);

            return response()->json($empleados,200);
        }
    }

}
