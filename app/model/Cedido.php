<?php
/**
 * Created by PhpStorm.
 * User: juanca
 * Date: 21/4/15
 * Time: 12:34
 */

namespace App\model;


use Illuminate\Database\Eloquent\Model;

class Cedido extends Model{

    protected $table = 'cedido';

    protected $fillable = ['DNI','Domicilio','Piso','Puerta','Localidad','Provincia','id-nicho','Id-cedido-Nicho'];
}