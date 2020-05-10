<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Kelas extends Model
{
    use SoftDeletes;
    protected $table = 'kelas';
    public $incrementing = false;
    protected $dates = ['deleted_at'];
}
