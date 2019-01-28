<?php

namespace App\Modelos;
use Illuminate\Database\Eloquent\Model;

/*Author jhonatan cudris */
class PlanTrabajoAsignacion  extends Model{

    //modelo que instancia la tabla plan trabajo asigancion para crear  el plan de trabajo

    protected $table ='plan_trabajo_asignacion';
    protected $primaryKey='id_plan_trabajo';

    public $timestamps=false;

    protected $fillable=['id_sucursal','fecha_creacion','id_supervisor','estado','idcoordinador', 'nombre'];







}
