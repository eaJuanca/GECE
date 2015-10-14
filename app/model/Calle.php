<?php
/**
 * Created by PhpStorm.
 * User: juanca
 * Date: 21/4/15
 * Time: 12:34
 */

namespace App\model;


use Illuminate\Database\Eloquent\Model;

class Calle extends Model{

    protected $table = 'GC_CALLE';

    protected $fillable = [
        'id',
        'nombre',
        'num_tramadas',
        'tipo_calle',
        'total',
        'num_panteones'
    ];
}