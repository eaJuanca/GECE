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
        'id',
        'idtitular',
        'idnicho',
        'idparcela',
        'iddifunto',
        'tipo',
        'anyo',
        'pendiente',
        'pagada'

    ];
}