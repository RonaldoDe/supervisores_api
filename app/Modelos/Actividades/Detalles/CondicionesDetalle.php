<?php

namespace App\Modelos\Actividades\Detalles;

use Illuminate\Database\Eloquent\Model;

class CondicionesDetalle extends Model
{
    protected $table ='condiciones_locativas_actividad';
 
     public $timestamps=false;
 
     protected $fillable=['id_actividad','id_condicion','estado_condicion','foto_condicion', 'observaciones'];
}
