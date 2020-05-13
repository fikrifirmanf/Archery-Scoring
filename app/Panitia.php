<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Panitia extends Model
{
    use SoftDeletes;
    protected $table = 'peserta';
    public $incrementing = false;
    protected $dates = ['deleted_at'];
}
