<?php
/**
 * Created by PhpStorm.
 * User: juanca
 * Date: 21/4/15
 * Time: 12:34
 */

namespace App\model;


use Illuminate\Database\Eloquent\Model;

class Nicho extends Model{

    protected $table = 'GC_NICHOS';

    protected $fillable = [

        'nom_facturado',
        'dir_facturado',
        'nif_facturado',
        'pob_facturado',
        'pro_facturado',
        'cp_facturado',
        'tel_facturado',
        'iban',
        'banco',
        'sucursal',
        'dc',
        'cuenta',
        'plaza',
        'titular',
        'tarifa',
        'observaciones',
        'cesion',
        'voluntades',
        'tipo',
        'GC_TITULAR_id',
        'sintitular',
        'formapago',
        'hijode1',
        'hijode2'
    ];
}