<?php

namespace App\Modelos\Actividades;

use Illuminate\Database\Eloquent\Model;

class ServicioBodega extends Model
{
    protected $table ='servicio_bodega';
    protected $primaryKey='id';

    public $timestamps=false;

    protected $fillable=['id_plan_trabajo','id_prioridad','fecha_inicio','fecha_fin','fecha_mod','observacion','calificacion_pv','calificacion', 'tiempo_actividad', 'tiempo_total', 'motivo_ausencia','id_estado', 'valor_pedido', 'valor_despacho', 'diferencia', 'nivel_servicio', 'revisa_pedidos_antes_enviarlos', 'utiliza_libreta_faltantes'];
}
