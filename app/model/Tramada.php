<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tramada extends Model
{
    protected $table = 'GC_Tramada';

    protected $fillable = [
        'tramada',
        'total',
        'GC_CALLE'
    ];
}