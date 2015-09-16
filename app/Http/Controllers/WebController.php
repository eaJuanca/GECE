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
        $difuntos = Difunto::all()->take(10);

        return view('difunto', compact('difuntos'));
    }


}
