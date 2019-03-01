<?php

namespace App\Modelos\Actividades;

use Illuminate\Database\Eloquent\Model;

class Senalizacion extends Model
{
    protected $table ='senalizacion';
    protected $primaryKey='id';

    public $timestamps=false;

    protected $fillable=['id_plan_trabajo','fecha_inicio','fecha_fin','fecha_mod','id_prioridad','id_estado','calificacion','observaciones', 'tiempo_actividad', 'tiempo_total', 'motivo_ausencia','calificacion_pv', 'senalizacion'];

}
