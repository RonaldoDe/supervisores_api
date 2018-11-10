<?php
namespace App\Modelos;
use Illuminate\Database\Eloquent\Model;
/*Author jhonatan cudris */

class Usuario_roles extends Model{
    //modelo que instancia la tabla usuario_roles para crear los registro de la misma  de la misma

    protected $table ='usuarios_roles';
    protected $primaryKey='id_usuario_roles';

    public $timestamps=false;

    protected $fillable=['id_rol','id_usuario','estado'];







}
