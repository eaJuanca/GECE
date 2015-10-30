<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Iva2 extends Model
{
    protected $table = 'GC_IVA';

    protected $fillable = [
        'cuenta',
        'tipo',
        'fecha_aplicacion'
    ];
}