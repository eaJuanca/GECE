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
        'nombre_titular',
        'responsable',
        'dom_titular',
        'cp_titular',
        'pob_titular',
        'exp_titular',
        'dni_titular',
        'tel_titular',
        'ema_titular',
        'nom_facturado',
        'dir_facturado',
        'nif_facturado',
        'pob_facturado',
        'pro_faturado',
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
        'tipo',
        'GC_Tramada_id'
    ];
}