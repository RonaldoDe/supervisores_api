<?php

namespace App\Modelos\Actividades;

use Illuminate\Database\Eloquent\Model;

class ProgramaMercadeo extends Model
{
    protected $table ='programa_mercadeo';
    protected $primaryKey='id';

    public $timestamps=false;

    protected $fillable=['id_plan_trabajo','id_prioridad','fecha_inicio','fecha_fin','fecha_mod','observacion','calificacion_pv','calificacion', 'tiempo_actividad', 'tiempo_total', 'motivo_ausencia','id_estado', 'promociones_separata', 'desc_escalonados', 'tienda_virtual', 'puntos_saludables', 'close_up'];
}
