<?php

namespace App\Modelos\Actividades;
use Illuminate\Database\Eloquent\Model;

/*Author jhonatan cudris */
class Remisiones extends Model{

    //modelo que instancia la tabla Apertura

    protected $table ='remisiones';
    protected $primaryKey='id_remision';

    public $timestamps=false;

    protected $fillable=['id_plan_trabajo','id_prioridad','fecha_inicio','fecha_fin','fecha_mod','observacion','calificacion_pv','calificacion','estado'];
}
