<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seguimiento extends Model
{
    protected $table ='segumiento';
    protected $primaryKey='id';

    public $timestamps=false;

    protected $fillable=['user_id','loged_at'];
}
