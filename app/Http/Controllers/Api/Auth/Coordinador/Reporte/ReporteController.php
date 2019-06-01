<?php

namespace App\Http\Controllers\Api\Auth\Coordinador\Reporte;

use Illuminate\Http\Request;
use Laravel\Passport\Client;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Modelos\PlanTrabajoAsignacion;
use Carbon\Carbon;
use App\Modelos\Reportes\SoporteTecnico;
use Mail;
use App\Http\Controllers\Helper\SenderEmail;
use App\Http\Controllers\Helper\TemplateEmail;

class ReporteController extends Controller
{
    //traer todos los usuarios y zonas de un coordinador
    public function mostrarReportePorCoordinador(){

        $user=DB::table('users as u')->where('u.id',Auth::id())->first();
        $cordinador=DB::table('coordinadores')
        ->where('correo',$user->email)
        ->first();

        $plan_trabajo = DB::table('plan_trabajo_asignacion as pt')
        ->where('pt.idcoordinador',$cordinador->id_cordinador)
        ->get();

        //array de las sucursales
        $sucursales_arr = array();
        foreach($plan_trabajo as $plan){
            $sucursales = DB::table('sucursales as su')
            ->select('su.cod_sucursal', 'su.nombre as nombre_sucursal', 'zo.descripcion_zona', 'us.nombre as nombre_supervisor', 'us.apellido','us.cedula')
            ->join('zona as zo','su.id_zona','zo.id_zona')
            ->join('usuario_zona as uz','zo.id_zona','uz.id_zona')
            ->join('usuarios_roles as ur','uz.id_usuario','ur.id_usuario_roles')
            ->join('usuario as us','ur.id_usuario','us.id_usuario')
            ->where('su.id_suscursal',$plan->id_sucursal)
            ->where('ur.id_usuario_roles',$plan->id_supervisor)
            ->get();
            foreach($sucursales as $sucursal){
                $sucursal->id_plan_trabajo = $plan->id_plan_trabajo;
                array_push($sucursales_arr, [$cordinador->nombre => [$sucursal->nombre_sucursal => $sucursales]]);
            }
        }

        return response()->json($sucursales_arr, 201);
    }
    // mostrar las actividades que tiene asiganad auna sucursal
    public function mostrarActividadesPorSucursal(Request $request)
    {

        $validator=\Validator::make($request->all(),[
            'id_plan_trabajo'=>'required|numeric'
        ]);
        if($validator->fails())
        {
          return response()->json( $errors=$validator->errors()->all() );
        }

        else
        {
            $actividades = DB::table('actividades as ac')
            ->where('ac.id_plan_trabajo',request('id_plan_trabajo'))
            ->get();
            //array para guardar los datos de lasactividades
            $actividades_arr = array();
            foreach($actividades as $ac){
                $activities = DB::table($ac->nombre_tabla.' as ac')
                ->where('ac.id_plan_trabajo',request('id_plan_trabajo'))
                ->get();
                array_push($actividades_arr, [$ac->nombre_actividad => $activities]);
            }
            if(count($actividades_arr) > 0){
                return response()->json($actividades_arr, 201);
            }else{
                return response()->json(["message" => 'No tienes actividades asignadas'],200);
            }
        }
    }
    //soporte tecnico, reporte de daños o sugerencias
    public function soporteTecnico(Request $request)
    {

        $validator=\Validator::make($request->all(),[
            'asunto'=>'required',
            'mensaje'=>'required',
        ]);
        if($validator->fails())
        {
          return response()->json( $errors=$validator->errors()->all(),400 );
        }

        else
        {
            $user=DB::table('users as u')->where('u.id',Auth::id())->first();
            if($user){
                $mensaje = request('mensaje');
                $send_email = SenderEmail::sendEmail('soportetecnico@binar10.co', 'Soporte tecnico SuperAT', request('mensaje'), TemplateEmail::soporteTecnico($mensaje));
                if($send_email == 1){
                // $mail = Mail::send('emails.soporte_tecnico', ['mensaje' => $mensaje], function($message) use($request){
                //     $message->to('soportetecnico@binar10.co')
                //             ->subject(request('asunto'));
                // });
                    return response()->json('Ya hemos recibido su petición, Gracias!', 200);
                }else{
                    return response()->json($send_email, 400);
                }
            }else{
                return response()->json('Usuario no encontrado', 400);
            }
        }
    }

}
