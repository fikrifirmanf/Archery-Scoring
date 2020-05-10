<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Team extends Model
{
    use SoftDeletes;
    protected $table = 'team';
    public $incrementing = false;
    protected $dates = ['deleted_at'];
}
