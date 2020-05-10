<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Konten extends Model
{
    use SoftDeletes;

    protected $table = "konten";
    public $incrementing = false;
    public $timestamps = true;
    protected $dates = ['deleted_at'];
}
