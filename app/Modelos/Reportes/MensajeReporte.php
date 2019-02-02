<?php

namespace App\Modelos\Reportes;

use Illuminate\Database\Eloquent\Model;

class MensajeReporte extends Model
{
    protected $table ='mensaje_reporte';
    protected $primaryKey='id';

    public $timestamps=false;

    protected $fillable=['id_reporte','nombre_usuario','tipo_usuario','mesanje','fecha'];
}
