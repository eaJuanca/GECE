<?php
/**
 * Created by PhpStorm.
 * User: juanca
 * Date: 21/4/15
 * Time: 12:34
 */

namespace App\model;


use Illuminate\Database\Eloquent\Model;

class Tcp_parcelas2 extends Model{

    protected $table = 'GC_Tarifa_cp_parcelas';

    protected $fillable = [
        'id',
        'tarifa'
    ];

}
/** esto es un poco basura */
//*comentario////