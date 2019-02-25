<?php

namespace App\Modelos\Actividades;

use Illuminate\Database\Eloquent\Model;

class RelacionVendedores extends Model
{
    protected $table ='relacion_vendedores';
    protected $primaryKey='id';

    public $timestamps=false;

    protected $fillable=['id_plan_trabajo','id_prioridad','fecha_inicio','fecha_fin','fecha_mod','observacion','calificacion_pv','calificacion', 'tiempo_actividad', 'tiempo_total', 'motivo_ausencia','id_estado', 'aplica_proceso_ideal_venta', 'relacion_vendedores'];
}
