<?php

namespace App\Modelos\Actividades;
use Illuminate\Database\Eloquent\Model;

/*Author jhonatan cudris */
class Apertura extends Model{

    //modelo que instancia la tabla Apertura

    protected $table ='apertura';
    protected $primaryKey='id_apertura';

    public $timestamps=false;

    protected $fillable=['id_plan_trabajo','fecha_inicio','fecha_fin','fecha_mod','id_prioridad','estado','calificacion','observaciones','calificacion_pv'];







}
