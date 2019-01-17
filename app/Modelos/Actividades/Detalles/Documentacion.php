<?php

namespace App\Modelos\Actividades\Detalles;

use Illuminate\Database\Eloquent\Model;

class Documentacion extends Model
{

     protected $table ='documentacion_actividad';
 
     public $timestamps=false;
 
     protected $fillable=['id_actividad','id_documento','documento_vencido','documento_renovado', 'observaciones'];
}
