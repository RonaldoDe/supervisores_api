<?php

namespace App\Modelos\Actividades;

use Illuminate\Database\Eloquent\Model;

class ActividadPtc extends Model
{
    protected $table ='actividades_ptc';
    protected $primaryKey='id';

    public $timestamps=false;

    protected $fillable=['id_plan_trabajo','titulo','fecha_inicio','fecha_fin','fecha_mod','id_prioridad','id_estado','calificacion','observacion', 'tiempo_actividad', 'tiempo_total', 'motivo_ausencia','calificacion_pv'];

}
