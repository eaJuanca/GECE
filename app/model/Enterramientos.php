<?php
/**
 * Created by PhpStorm.
 * User: juanca
 * Date: 21/4/15
 * Time: 12:34
 */

namespace App\model;


use Illuminate\Database\Eloquent\Model;

class Enterramientos extends Model{

    protected $table = 'enterramientos';

    protected $fillable = ['NOMBRE_APELLIDOS_DIFUNTO','EDAD','DNI','FECHAENTERRAMIENTO','FECHADEFUNCION','HORADEFUNCION','CAUSEFALLECIMIENTO','TIPOFERETRO','FUNERAL','ID-NICHO'];
}



