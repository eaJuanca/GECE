<?php
/**
 * Created by PhpStorm.
 * User: juanca
 * Date: 21/4/15
 * Time: 12:34
 */

namespace App\model;


use Illuminate\Database\Eloquent\Model;

class Titular extends Model{

    protected $table = 'GC_TITULAR';

    protected $fillable = [

        'nombre_titular',
        'responsable',
        'dom_titular',
        'cp_titular',
        'pob_titular',
        'exp_titular',
        'dni_titular',
        'tel_titular',
        'ema_titular'

    ];
}