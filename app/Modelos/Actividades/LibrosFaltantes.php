<?php

namespace App\Modelos\Actividades;
use Illuminate\Database\Eloquent\Model;

/*Author jhonatan cudris */
class LibrosFaltantes extends Model{

    //modelo que instancia la tabla Apertura

    protected $table ='libros_faltantes';
    protected $primaryKey='id';

    public $timestamps=false;

    protected $fillable=['id_plan_trabajo','id_prioridad','fecha_inicio','fecha_fin','fecha_mod','observacion','calificacion_pv', 'tiempo_actividad', 'tiempo_total', 'motivo_ausencia','calificacion','estado'];
}
