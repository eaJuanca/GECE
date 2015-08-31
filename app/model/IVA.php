<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IVA extends Model
{
    protected $table = 'GC_IVA';

    protected $fillable = [
        'cuenta',
        'tipo',
        'fecha_aplicacion'
    ];
}