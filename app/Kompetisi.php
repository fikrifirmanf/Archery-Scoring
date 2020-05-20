<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Kompetisi extends Model
{
    use SoftDeletes;
    protected $table = 'kompetisi';
    public $incrementing = false;
    protected $dates = ['deleted_at'];
}
