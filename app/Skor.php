<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Skor extends Model
{
    use SoftDeletes;
    protected $table = 'skor';
    public $incrementing = false;
    protected $dates = ['deleted_at'];
}
