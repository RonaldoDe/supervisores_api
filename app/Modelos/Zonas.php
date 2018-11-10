<?php

namespace App\Modelos;
use Illuminate\Database\Eloquent\Model;

/*Author jhonatan cudris */
class Zonas extends Model{

    //modelo que instancia la tabla cordiandores para crear los usuario de la misma

    protected $table ='zona';
    protected $primaryKey='id_zona';

    public $timestamps=false;

    protected $fillable=['descripcion_zona','id_region','id_usuario_roles'];







}
