<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Seguimiento extends Model
{
    protected $table ='seguimiento';

    public $timestamps=false;

    protected $fillable=['user_id', 'logged_at'];
}
