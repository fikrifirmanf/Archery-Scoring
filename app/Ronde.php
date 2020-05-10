<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Ronde extends Model
{
    use SoftDeletes;
    protected $table = 'ronde';
    public $incrementing = false;
    protected $dates = ['deleted_at'];
}
