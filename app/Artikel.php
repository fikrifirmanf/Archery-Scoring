<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Artikel extends Model
{
    use SoftDeletes;
    protected $table = 'artikel';
    public $incrementing = false;
    protected $dates = ['deleted_at'];
}
