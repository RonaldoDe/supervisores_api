<?php

namespace App\Modelos;
use Illuminate\Database\Eloquent\Model;

/*Author jhonatan cudris */
class Sucursales extends Model{

    //modelo que instancia la tabla cordiandores para crear los usuario de la misma

    protected $table ='sucursales';
    protected $primaryKey='id_suscursal';

    public $timestamps=false;

    protected $fillable=['cod_sucursal','nombre','direccion','longitud','latitud','id_tipo_cadena','id_tipo_poblacion','id_zona'];
}
