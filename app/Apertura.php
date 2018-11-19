<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apertura extends Model
{

    protected $table = 'apertura';
    protected $primaryKey = 'id_apertura';

    protected $fillable = [
        'id_plan_trabajo', 'fecha_inicio', 'fecha_fin', 'fecha_mod', 'observaciones', 'id_prioridad', 'estado', 'calificacion', 'calificacion_pv',
    ];

    public $timestamps=false;

}
