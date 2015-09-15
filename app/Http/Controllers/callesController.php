<?php
/**
 * Created by PhpStorm.
 * User: juanca
 * Date: 26/8/15
 * Time: 18:03
 */
namespace App\Http\Controllers;


use App\model\Calle;
use Illuminate\Http\Request;


class callesController extends Controller {


    function create(Request $r){
       // $calle = new Calle($r->all());
        dd("hola");
        //$calle->save();

    }


}