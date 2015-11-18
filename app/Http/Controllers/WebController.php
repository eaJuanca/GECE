<?php

namespace App\Http\Controllers;

use App\model\Difunto;
use App\model\VDifuntos;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use App\Http\Requests;

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

        $total = VDifuntos::count();
        $difuntos = VDifuntos::take(10)->get();
        $search = 0;

        return view('difunto', compact('difuntos','total','search'));
    }

    public function DifuntosPagination(Request $r){

    }
    /**
     * Comentario cambios
     */

}
