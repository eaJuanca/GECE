<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Tramada extends Model
{
    protected $table = 'GC_Tramada';

    protected $fillable = [
        'id',
        'tramada',
        'nichos',
        'GC_CALLE_id',
        'GC_PARCELA_id'
    ];
}