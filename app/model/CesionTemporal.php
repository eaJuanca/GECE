<?php
/**
 * Created by PhpStorm.
 * User: juanca
 * Date: 21/4/15
 * Time: 12:34
 */

namespace App\model;


use Illuminate\Database\Eloquent\Model;

class CesionTemporal extends Model{

    protected $table = 'cesion_temporal';

    protected $fillable = ['FechaAlta','FechaBaja','id-nicho','id-cedido'];
}