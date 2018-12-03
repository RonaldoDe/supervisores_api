<?php

namespace App\Modelos\Actividades;
use Illuminate\Database\Eloquent\Model;

/*Author jhonatan cudris */
class RevisionCompletaInventarios extends Model{

    //modelo que instancia la tabla Apertura

    protected $table ='revision_completa_inventarios';
    protected $primaryKey='id_revision';

    public $timestamps=false;

    protected $fillable=['id_plan_trabajo','id_prioridad','fecha_inicio','fecha_fin','fecha_mod','observacion','calificacion_pv','calificacion','estado'];
}
