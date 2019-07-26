<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Notificaciones extends Model
{
    protected $table ='notificaciones';

    public $timestamps=false;

    protected $fillable=['id_plan_trabajo', 'id_coordinador', 'id_sucursal','nombre_plan','nombre_actividad','nombre_supervisor', 'nombre_sucursal','leido','tipo','fecha', 'id_usuario', 'tipo_usuario'];
}
