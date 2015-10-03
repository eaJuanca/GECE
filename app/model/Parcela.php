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

    protected $table = 'GC_Parcela';

    protected $fillable = [
        'id',
        'tamanyo',
        'GC_PANTEON'
    ];
}