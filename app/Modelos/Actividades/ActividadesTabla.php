<?php

namespace App\Modelos\Actividades;
use Illuminate\Database\Eloquent\Model;

/*Author jhonatan cudris */
class ActividadesTabla extends Model{

    //modelo que instancia la tabla Apertura

    protected $table ='actividades';
    protected $primaryKey='id';

    public $timestamps=false;

    protected $fillable=['id_plan_trabajo','id_prioridad','nombre_tabla','nombre_actividad'];
}
