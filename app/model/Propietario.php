<?php
/**
 * Created by PhpStorm.
 * User: juanca
 * Date: 21/4/15
 * Time: 12:34
 */

namespace App\model;


use Illuminate\Database\Eloquent\Model;

class Propietario extends Model{

    protected $table = 'propietarios';

    protected $fillable = ['DNI','Domicilio','Piso','Puerta','Conyuge','N-Padre','N-Madre','Localidad','Provincia','id-sucesion'];
}