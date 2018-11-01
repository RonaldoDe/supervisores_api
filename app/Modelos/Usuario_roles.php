<?php
namespace App\Modelos;
use Illuminate\Database\Eloquent\Model;


class Usuario_roles extends Model{

    protected $table ='usuarios_roles';
    protected $primaryKey='id_usuario_roles';

    public $timestamps=false;

    protected $fillable=['id_rol','id_usuario','estado'];







}
