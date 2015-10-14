<?php
/**
 * Created by PhpStorm.
 * User: juanca
 * Date: 21/4/15
 * Time: 12:34
 */

namespace App\model;


use Illuminate\Database\Eloquent\Model;

class Tm_nichos extends Model{

    protected $table = 'GC_Tarifa_m_nichos';

    protected $fillable = [
        'id',
        'tarifa'
    ];
}