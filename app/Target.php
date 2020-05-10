<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Target extends Model
{
    use SoftDeletes;
    protected $table = 'no_target';
    public $incrementing = false;
    protected $dates = ['deleted_at'];
}
