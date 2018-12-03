<?php

namespace App\Modelos\Actividades;
use Illuminate\Database\Eloquent\Model;

/*Author jhonatan cudris */
class EvaluacionPedidos extends Model{

    //modelo que instancia la tabla Apertura

    protected $table ='evaluacion_pedidos';
    protected $primaryKey='id_evaluacion_pedidos';

    public $timestamps=false;

    protected $fillable=['id_plan_trabajo','id_prioridad','fecha_inicio','fecha_fin','fecha_mod','num_remision','observacion','calificacion_pv','calificacion','estado'];
}
