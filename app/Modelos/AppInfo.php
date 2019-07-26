<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class AppInfo extends Model
{
    protected $table ='informacion_app';

    public $timestamps=false;

    protected $fillable=[
        'version_android',
        'version_ios'
    ];
}
