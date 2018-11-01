<?php

namespace App\Modelos;
use Illuminate\Database\Eloquent\Model;


class Coordinadores extends Model{

    protected $table ='coordinadores';
    protected $primaryKey='id_cordinador';

    public $timestamps=false;

    protected $fillable=['nombre','apellido','cedula','correo','password','telefono'];







}
