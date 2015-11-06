<?php

namespace App\Http\Controllers;

use App\model\Factura;
use App\model\Iva2;
use App\model\Tcp_nichos;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\model\VFacturas;

class PdfFacturasGenerator extends Controller
{

    public function facturaNicho($id){


        $f = VFacturas::find($id);

        $tr = $f->tramada;
        $coste = Tcp_nichos::find($tr);
        $iva = Iva2::find(1);


        $view =  \View::make('pdf.pdfcesion', compact('f','coste','iva'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('invoice.pdf', array( 'Attachment'=>1 ));

    }

}
