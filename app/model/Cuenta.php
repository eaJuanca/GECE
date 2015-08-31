<?php
/**
 * Created by PhpStorm.
 * User: juanca
 * Date: 21/4/15
 * Time: 12:34
 */

namespace App\model;


use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model{

    protected $table = 'GC_CUENTAS';

    protected $primaryKey = 'numero';

    protected $fillable = [
        'numero',
        'descripcion',
        'tipo'
    ];
}