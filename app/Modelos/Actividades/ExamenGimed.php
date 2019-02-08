<?php

namespace App\Modelos\Actividades;

use Illuminate\Database\Eloquent\Model;

class ExamenGimed extends Model
{
    protected $table ='examen_gimed';
    protected $primaryKey='id';

    public $timestamps=false;

    protected $fillable=['id_plan_trabajo','id_prioridad','fecha_inicio','fecha_fin','fecha_mod','observacion','calificacion_pv','calificacion', 'tiempo_actividad', 'tiempo_total', 'motivo_ausencia','id_estado', 'examen_gimed'];
}
