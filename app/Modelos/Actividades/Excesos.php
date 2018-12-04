<?php

namespace App\Modelos\Actividades;
use Illuminate\Database\Eloquent\Model;

/*Author jhonatan cudris */
class Excesos extends Model{

    //modelo que instancia la tabla Apertura

    protected $table ='excesos';
    protected $primaryKey='id_excesos';

    public $timestamps=false;

    protected $fillable=['id_plan_trabajo','id_prioridad','fecha_inicio','fecha_fin','fecha_mod','observacion','calificacion_pv','calificacion','estado'];
}