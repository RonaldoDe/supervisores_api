<?php

namespace App\Modelos\Actividades;

use Illuminate\Database\Eloquent\Model;

class Domicilio extends Model
{
    protected $table ='domicilios';
    protected $primaryKey='id';

    public $timestamps=false;

    protected $fillable=['id_plan_trabajo','id_prioridad','fecha_inicio','fecha_fin','fecha_mod','observacion','calificacion_pv','calificacion', 'tiempo_actividad', 'tiempo_total', 'motivo_ausencia','id_estado', 'mes_anterior', 'ventas_domicilio_proyeccion', 'numero_mensajero_planta', 'pro_domicilio_mensajero', 'mes_actual', 'dias_transcurridos'];
}
