<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rules extends Model
{
    use SoftDeletes;
    protected $table = 'rules';
    public $incrementing = false;
    protected $dates = ['deleted_at'];
}
