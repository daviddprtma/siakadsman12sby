<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
    //
    protected $table = 'kehadirans';

    protected $fillable = ['keterangan'];
}
