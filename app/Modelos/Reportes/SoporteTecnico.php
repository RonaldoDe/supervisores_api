<?php

namespace App\Modelos\Reportes;

use Illuminate\Database\Eloquent\Model;
class SoporteTecnico extends Model
{
    protected $table ='soporte_tecnico';
    protected $primaryKey='id';

    public $timestamps=false;

    protected $fillable=['aunto','correo','fecha'];
}
