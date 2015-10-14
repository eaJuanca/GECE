<?php
/**
 * Created by PhpStorm.
 * User: juanca
 * Date: 21/4/15
 * Time: 12:34
 */

namespace App\model;


use Illuminate\Database\Eloquent\Model;

class Tct_parcelas extends Model{

    protected $table = 'GC_Tarifa_ct_parcelas';

    protected $fillable = [
        'id',
        'tarifa'
    ];
}