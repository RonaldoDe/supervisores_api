<?php

namespace App\Modelos;
use Illuminate\Database\Eloquent\Model;

/*Author jhonatan cudris */
class Coordinadores extends Model{

    //modelo que instancia la tabla cordiandores para crear los usuario de la misma

    protected $table ='coordinadores';
    protected $primaryKey='id_cordinador';

    public $timestamps=false;

    protected $fillable=['nombre','apellido','cedula','correo','password','telefono','asignado'];







}
