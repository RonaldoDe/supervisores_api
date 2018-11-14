<?php

namespace App\Http\Controllers\Api\Auth\Coordinador\Actividades;

use Illuminate\Http\Request;
use Laravel\Passport\Client;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Modelos\Actividades\Apertura;
use App\Modelos\Actividades\DocumentacionLegal;
use App\Modelos\Relevancia;
use Carbon\Carbon;
/*Author jhonatan cudris */

//controlador que crea el registro de apertura  y recibe os parametros
//del front para crear una activdad y asiganerle un plan rbajo
class CrearActividadParaPlanTrabajo extends Controller
{

    public function crearActividadApertura(Request $request)
    {


        $validator=\Validator::make($request->all(),[
            'id_prioridad' => 'required',
            'id_frecuencia'=>'required',

            'id_plan_trabajo'=>'required',




        ]);
        if($validator->fails())
        {
          return response()->json( $errors=$validator->errors()->all() );
        }

        else
        {


            try
            {
                //transaccion para hacer las inserciones en la tabala relevancia y me devuelbe el id de esa relevancia
                //asignada para asignarsela a una actividad del plana de trabajo
                DB::beginTransaction();
                //instancia del modelo relevancia para crear un registro de esta tabla
                $relevancia =Relevancia::create([

                    'id_prioridad' =>request('id_prioridad'),
                    'id_frecuencia' =>request('id_frecuencia'),
                ]);

            //consulta que recupera el nombre del id de la frecuencia creada en ese momento y se lo asigna alas actividades
            //que se escojan en el plan de trabajo
                $nom_frecuencia=DB::table('frecuencia as f')
                ->where('f.id_frecuencia','=',$relevancia->id_frecuencia)
                ->select('f.nombre','f.id_frecuencia')->first();

                    //varaiable que alamacena el dato de la fecha inicial pàra hacer inserciones en la base de dato
                    //dependiendo el tipo de la  frecuencia que se escoja (semanla,quincenal )
            $fecha_ini= request('fecha_ini');//->enviar por obligacion es requerida desde el front

            //validaciones de lo que me debuelve la variable nom_frecuencia para insertar dichos registros
            //dependiendo el nomre de la frecuencia del registro de la relevancia que se inserta en ese registro
             if($nom_frecuencia->nombre=="semanal"){

                $num_d=7;
                $mytime=Carbon::now('America/Bogota');
                for($i=0; $i<$num_d; $i++)
                {//ciclo y funcion strtotime que me hace las inserciones dependiendo la frecuencia que recibe
                    $nuevafecha = strtotime ( '+'.$i.' day' , strtotime ( $fecha_ini ) ) ;
                    $nuevafecha = date ( 'Y-m-j' , $nuevafecha );

                    $apertura =Apertura::create([

                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>$nuevafecha,
                        'fecha_fin' =>$nuevafecha.' '.'23:59:00',
                        'observaciones'=>'',
                        'id_relevancia' =>$relevancia->id_relevancia,
                        'estado' =>'Activo',

                    ]);

                }

            }else if($nom_frecuencia->nombre=="quincenal"){
                //validcion quinenal

                $num_d=15;
                $mytime=Carbon::now('America/Bogota');
                for($i=0; $i<$num_d; $i++)
                {
                    $nuevafecha = strtotime ( '+'.$i.' day' , strtotime ( $fecha_ini ) ) ;
                    $nuevafecha = date ( 'Y-m-j' , $nuevafecha );

                    $apertura =Apertura::create([



                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>$nuevafecha,
                        'fecha_fin' =>$nuevafecha.' '.'23:59:00',
                        'observaciones'=>'',
                        'id_relevancia' =>$relevancia->id_relevancia,
                        'estado' =>'Activo',

                    ]);

                }

            }else if($nom_frecuencia->nombre=="diaria"){





                    $apertura =Apertura::create([



                        'id_plan_trabajo' =>request('id_plan_trabajo'),
                        'fecha_inicio' =>$fecha_ini,
                        'fecha_fin' =>request('fecha_fin'),
                        'observaciones'=>'',
                        'id_relevancia' =>$relevancia->id_relevancia,
                        'estado' =>'Activo',

                    ]);



                }
                else if($nom_frecuencia->id_frecuencia==2){
//esa funcion es diferenet ya que no recibe el nombre de la frecuencia si no que valida el id de la relevanciainsertada
//en ese momento y luego entra al id de la frecuencia que debulve personalizada  para crear inserciones con fechas pero
//nalizadas
                    //parametr que recibe un array llamado de la misma manera  array_fechas
                 $fechas=request('array_fechas');
                 //codificacion a json
                 $fechas_converter=json_encode($fechas,true);
                 //decodificcion del reques recibido para iterar el aary
                 $fechas_converter_d=json_decode($fechas_converter,true);



                    //ciclo que me me permite iterar el array  mediante la funcion sizeof
                    //itera mediante las propiedades del array asi como le mando los parametros
                    //exactos los nombres de las propiedades
                    for($i=0; $i<sizeof($fechas_converter_d);$i++)
                    {

//validar la fecha de inicio en el requiere de la funcion validater pendiente cv
                        $apertura =Apertura::create([

                            'id_plan_trabajo' =>request('id_plan_trabajo'),
                            'fecha_inicio' =>$fechas_converter_d[$i]["fecha_inicio"],
                            'fecha_fin' =>$fechas_converter_d[$i]["fecha_fin"],
                            'observaciones'=>'',
                            'id_relevancia' =>$relevancia->id_relevancia,
                            'estado' =>'Activo',

                        ]);

                    }



                }




            DB::commit();

            return response()->json(["succes"=>" registros creado"]);
            }

            catch(Exeption $e){


                DB::rollBack();


        }
    }
}

//funcion para crear Actividad documnetacion legal del punto de venta  como este actividad se hace cada cierto tiempo
//le mandamos una frecuencia perznalizada paraq ue le cordinador inserte las fechas a estipuladas a cumplir cierta actividad
//
public function crearActividadDocumentacionLegal(Request $request){

    //imporante el id del plana detrabajo debe estar creado a la hora de crear las actividades a dicho plan de trabajo

    $validator=\Validator::make($request->all(),[
        'id_prioridad' => 'required',
        'id_plan_trabajo'=>'required',
        'fecha_inicio'=>'required',
        'fecha_fin'=>'required'




    ]);
    if($validator->fails())
    {
      return response()->json( $errors=$validator->errors()->all() );
    }

    else
    {
        try
        {

            DB::beginTransaction();
//se crea el registro de la relevancia dentro de esta tabla para luego insertarla el id de este registro
//  a modo de transaccion a la tabla documentacion_legal
            $relevancia =Relevancia::create([

                'id_prioridad' =>request('id_prioridad'),
                'id_frecuencia' =>2,
            ]);

//instancia del modelo documentacion legal para crear un registro de esta tabla
            $documentacion_legal =DocumentacionLegal::create([

                'id_plan_trabajo' =>request('id_plan_trabajo'),
                'fecha_inicio' =>request('fecha_inicio'),
                'fecha_fin' =>request('fecha_fin'),
                'observacion'=>'',
                'id_relevancia' =>$relevancia->id_relevancia,
                'estado' =>'Activo',

            ]);

            DB::commit();

            return response()->json(["succes"=>" Actividad documentacion legal creada"]);
        }

        catch(Exeption $e){


            DB::rollBack();


    }


    }



}




    //metodo que debuelve el contenido de la tabla prioridades para asiganrselo a una actvidad en esécifico
    public function MostrarTablaPrioridad(){

        $prioridad = DB::table('prioridad')->get();
        return response()->json(["prioridades"=>$prioridad]);


    }

    //metodo que debuelve el contenido de la tabla frecuencia para asiganrselo a una actvidad en esécifico
    public function MostrarTablafrecuencia(){

        $frecuecia = DB::table('frecuencia')->get();
        return response()->json(["frecuencias"=>$frecuecia]);


    }


}



