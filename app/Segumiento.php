<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Segumiento extends Model
{
    protected $table ='segumiento';
    protected $primaryKey='id_cordinador';

    public $timestamps=false;

    protected $fillable=['user_id','loged_at'];
}
