<?php

namespace App\Modelos\Actividades;

use Illuminate\Database\Eloquent\Model;

class InventarioMercancia extends Model
{
    protected $table ='inventario_mercancia';
    protected $primaryKey='id';

    public $timestamps=false;

    protected $fillable=['id_plan_trabajo','id_prioridad','fecha_inicio','fecha_fin','fecha_mod','observacion','calificacion_pv','calificacion', 'tiempo_actividad', 'tiempo_total', 'motivo_ausencia','id_estado', 'valor_actual', 'dias_inventario', 'inv_optimo', 'valor_dev_cierre_mes', 'dev_vencimiento_m_estado'];
}
