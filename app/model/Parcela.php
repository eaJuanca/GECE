<?php
/**
 * Created by PhpStorm.
 * User: juanca
 * Date: 21/4/15
 * Time: 12:34
 */

namespace App\model;


use Illuminate\Database\Eloquent\Model;

class Parcela extends Model{

    protected $table = 'GC_Parcelas';

    protected $fillable = [
        'id',
        'tamanyo',
        'GC_PANTEON',
        'numero',
        'nom_facturado',
        'dir_facturado',
        'nif_facturado',
        'pob_facturado',
        'pro_facturado',
        'cp_facturado',
        'tel_facturado',
        'iban',
        'GC_TITULAR_id',
        'banco',
        'sucursal',
        'dc',
        'cuenta',
        'plaza',
        'titular',
        'tafifa',
        'observaciones',
        'voluntades'
    ];
}