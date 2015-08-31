<?php
/**
 * Created by PhpStorm.
 * User: juanca
 * Date: 21/4/15
 * Time: 12:34
 */

namespace App\model;


use Illuminate\Database\Eloquent\Model;

class TarifaMantenimiento extends Model{

    protected $table = 'GC_Tarifa_mantenimiento';

    protected $fillable = [
        'anyo',
        'importe',
        'importe_panteon',
        'importe_capilla',
        'subcuenta'

    ];
}