<?php

namespace App\Modelos\Actividades;
use Illuminate\Database\Eloquent\Model;

/*Author jhonatan cudris */
class PapeleriaConsignaciones extends Model{

    //modelo que instancia la tabla Apertura

    protected $table ='papeleria_consignaciones';
    protected $primaryKey='id_papel_consignaciones';

    public $timestamps=false;

    protected $fillable=['id_plan_trabajo','id_prioridad','papeleria','valor_consignacion','valor_faltante','valor_sobrante','fecha_inicio','fecha_fin','fecha_mod','observacion','calificacion_pv','calificacion','estado'];
}
