<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Notificaciones extends Model
{
    protected $table ='notificaciones';

    public $timestamps=false;

    protected $fillable=['id_plan_trabajo','nombre_plan','nombre_actividad','nombre_supervisor', 'nombre_sucursal','leido','fecha'];
}
