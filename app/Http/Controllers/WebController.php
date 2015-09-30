<?php

namespace App\Http\Controllers;

use App\model\Difunto;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class WebController extends Controller
{
    /**
    *Muesta la pagina principal de difunto
     */
    public function DifuntoIndex()
    {

        $total = Difunto::count();
        $difuntos = Difunto::take(10)->get();

        return view('difunto', compact('difuntos','total'));
    }

    public function DifuntosPagination(Request $r){

    }


}