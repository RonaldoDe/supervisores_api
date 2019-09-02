<?php

namespace App\Modelos\Reportes;

use Illuminate\Database\Eloquent\Model;

class ReporteSupervisor extends Model
{
    protected $table ='reportes_supervisor';
    protected $primaryKey='id';

    public $timestamps=false;

    protected $fillable=['id_supervisor','id_coordinador','id_sucursal','nombre_reporte','observaciones','foto','estado_corregido', 'estado_listar', 'id_categoria', 'created_at'];
}
