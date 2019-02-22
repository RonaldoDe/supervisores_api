<?php

namespace App\Modelos\Log;

use Illuminate\Database\Eloquent\Model;

class LogError extends Model
{
    protected $table ='log_errores';
    protected $primaryKey='id';

    public $timestamps=false;

    protected $fillable=['header','body','id_usuario','tipo_usuario','fecha','resuelto'];
}
