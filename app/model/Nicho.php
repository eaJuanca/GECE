<?php
/**
 * Created by PhpStorm.
 * User: juanca
 * Date: 21/4/15
 * Time: 12:34
 */

namespace App\model;


use Illuminate\Database\Eloquent\Model;

class Nicho extends Model{

    protected $table = 'nichos';

    protected $fillable = ['Grupo/calle','Fila','Estado1','id-propietario','id-cedido','id-enterramiento'];
}