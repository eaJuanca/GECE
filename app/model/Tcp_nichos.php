<?php
/**
 * Created by PhpStorm.
 * User: juanca
 * Date: 21/4/15
 * Time: 12:34
 */

namespace App\model;


use Illuminate\Database\Eloquent\Model;

class Tcp_nichos extends Model{

    protected $table = 'GC_Tarifa_cp_nichos';

    protected $fillable = [
        'id',
        'tarifa'
    ];
}