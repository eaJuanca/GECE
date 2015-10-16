<?php

namespace App\Http\Controllers;

use App\model\Difunto;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class WebController extends Controller
{
    /**
    *Muesta la pagina principal de difunto
     *
     */

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
        $this->middleware('auth');


    }


    public function home(){

        return view('home');

    }

    public function DifuntoIndex()
    {

        $total = Difunto::count();
        $difuntos = Difunto::take(10)->get();
        $search = 0;

        return view('difunto', compact('difuntos','total','search'));
    }

    public function DifuntosPagination(Request $r){

    }
    /**
     * Comentario cambios
     */

}
