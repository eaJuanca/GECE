<?php

namespace App\Http\Controllers;

use App\model\Factura;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PdfFacturasGenerator extends Controller
{

    public function facturaNicho($id){

        $factura = Factura::find($id);


        $view =  \View::make('pdf.pdfcesion', compact(''))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('invoice.pdf', array( 'Attachment'=>1 ));

    }

}
