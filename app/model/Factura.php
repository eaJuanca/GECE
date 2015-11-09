<?php
/**
 * Created by PhpStorm.
 * User: juanca
 * Date: 21/4/15
 * Time: 12:34
 */

namespace App\model;


use Illuminate\Database\Eloquent\Model;

class Factura extends Model{

    protected $table = 'GC_Factura';

    protected $fillable = [

        'idtitular',
        'idnicho',
        'idparcela',
        'iddifunto',
        'inicio',
        'tipo_adquisicion',
        'fin',
        'serie',
        'numero',
        'pendiente',
        'pagada',
        'base',
        'iva',
        'total',
        'calle',
        'parcela',
        'tramada',
        'metros_parcela',
        'numero_nicho',
        'nombre_titular',
        'dni_titular',
        'domicilio_titular',
        'cp_titular',
        'poblacion_titular',
        'provincia_titular',
        'nombre_difunto',
        'nombre_facturado',
        'dni_facturado',
        'domicilio_facturado',
        'cp_facturado',
        'poblacion_facturado',
        'provincia_facturado'

    ];
}