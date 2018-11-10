<?php

namespace App\Modelos;
use Illuminate\Database\Eloquent\Model;

/*Author jhonatan cudris */
class Relevancia extends Model{

    //modelo que instancia la tabla cordiandores para crear los usuario de la misma

    protected $table ='relevancia';
    protected $primaryKey='id_relevancia';

    public $timestamps=false;

    protected $fillable=['id_prioridad','id_frecuencia'];







}
