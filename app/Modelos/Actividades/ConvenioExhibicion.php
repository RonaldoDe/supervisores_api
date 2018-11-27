<?php

namespace App\Modelos\Actividades;
use Illuminate\Database\Eloquent\Model;

/*Author jhonatan cudris */
class ConvenioExhibicion extends Model{

    //modelo que instancia la tabla Apertura

    protected $table ='convenio_exhibicion';
    protected $primaryKey='id_convenio_exhibicion';

    public $timestamps=false;

    protected $fillable=['id_plan_trabajo','id_prioridad','fecha_inicio','fecha_fin','fecha_mod','observacion','calificacion_pv','calificacion','estado'];
}
