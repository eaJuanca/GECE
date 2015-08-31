<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TarifaServicios extends Model
{
    protected $table = 'GC_Tarifa_servicios';

    protected $fillable = [
        'concepto',
        'importe',
        'subcuenta'
    ];
}
