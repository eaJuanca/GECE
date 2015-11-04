<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class LineaFactura extends Model
{
    protected $table = 'linea_factura';

    protected $fillable = [
        'GC_Tarifa_servicios_id',
        'GC_Factura_id',
        'fecha_aplicacion'
    ];
}