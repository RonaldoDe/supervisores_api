<?php

namespace App\Modelos\Actividades;
use Illuminate\Database\Eloquent\Model;

/*Author jhonatan cudris */
class CondicionesLocativas extends Model{

    //modelo que instancia la tabla Apertura

    protected $table ='condiciones_locativas';
    protected $primaryKey='id_condiciones';

    public $timestamps=false;

    protected $fillable=['id_plan_trabajo','id_prioridad','fecha_inicio','fecha_fin','fecha_mod','observacion','calificacion_pv','calificacion','estado'];
}
