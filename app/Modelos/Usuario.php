<?php

namespace App\Modelos;
use Illuminate\Database\Eloquent\Model;


class Usuario extends Model{

    protected $table ='usuario';
    protected $primaryKey='id_usuario';

    public $timestamps=false;

    protected $fillable=['nombre','apellido','cedula','correo','password','telefono'];







}
