<?php
/**
 * Created by PhpStorm.
 * User: juanca
 * Date: 21/4/15
 * Time: 12:34
 */

namespace App\model;


use Illuminate\Database\Eloquent\Model;

class Difunto extends Model{

    protected $table = 'GC_DIFUNTOS';

    protected $fillable = [
        'nom_difunto',
        'ape_difunto',
        'dom_difunto',
        'pob_difunto',
        'sex_difunto',
        'eda_difunto',
        'dni_difunto',
        'est_difunto',
        'fec_fall_difunto',
        'lug_fall_difunto',
        'cau_fall_difunto',
        'med_difunto',
        'loc_fall_difunto',
        'fec_inh_difunto',
        'tip_inh_difunto',
        'exp_inh_difunto',
        'fun_inh_difunto',
        'nom_sol_difunto',
        'ape_sol_difunto',
        'dom_sol_difunto',
        'loc_sol_difunto',
        'dni_sol_difunto',
        'tel_sol_difunto',
        'obs_difunto',
        'GC_NICHOS_id'
        ];
}