<?php

namespace App\Http\Controllers;

use App\model\Factura;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\model\VFacturas;

class PdfFacturasGenerator extends Controller
{

    public function facturaNicho($id){


        $f = VFacturas::find($id);


        $view =  \View::make('pdf.pdfcesion', compact('f'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('invoice.pdf', array( 'Attachment'=>1 ));

    }

}
