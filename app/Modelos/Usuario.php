<?php

namespace App\Modelos;
use Illuminate\Database\Eloquent\Model;
/*Author jhonatan cudris */

class Usuario extends Model{
//modelo que instancia la tabla usuario para crear los usuario de la misma
    protected $table ='usuario';
    protected $primaryKey='id_usuario';

    public $timestamps=false;

    protected $fillable=['nombre','apellido','cedula','correo','password','telefono'];







}
