<?php

namespace App\Modelos;
use Illuminate\Database\Eloquent\Model;

/*Author jhonatan cudris */
class Region extends Model{

    //modelo que instancia la tabla cordiandores para crear los usuario de la misma

    protected $table ='region';
    protected $primaryKey='id_region';

    public $timestamps=false;

    protected $fillable=['id_cordinador','nombre','descripcion'];







}
