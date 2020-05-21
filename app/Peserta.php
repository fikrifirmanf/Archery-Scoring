<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Peserta extends Model
{
    use SoftDeletes;
    protected $table = 'peserta';
    public $incrementing = false;
    protected $dates = ['deleted_at'];
    protected $fillable = ['uuid', 'no_target', 'nama_peserta', 'jk', 'team', 'kategori', 'kelas'];
}
