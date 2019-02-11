<?php

namespace App\Modelos\Actividades;

use Illuminate\Database\Eloquent\Model;

class CapturaClientes extends Model
{
    protected $table ='captura_cliente';
    protected $primaryKey='id';

    public $timestamps=false;

    protected $fillable=['id_plan_trabajo','fecha_inicio','fecha_fin','fecha_mod','id_prioridad','estado','calificacion','observaciones', 'tiempo_actividad', 'tiempo_total', 'motivo_ausencia','calificacion_pv'];


}
