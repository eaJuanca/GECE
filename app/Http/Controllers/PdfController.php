<?php

namespace App\Http\Controllers;

use App\Http\Requests;


class PdfController extends Controller
{

    public function invoice()
    {
        $data = $this->getData();
        $date = date('Y-m-d');
        $invoice = "2222";
        $view =  \View::make('pdf.invoice', compact('data', 'date', 'invoice'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('invoice.pdf', array( 'Attachment'=>1 ));
    }

    public function getData()
    {
        $data =  [
            'quantity'      => '1' ,
            'description'   => 'some ramdom text',
            'price'   => '500',
            'total'     => '500'
        ];
        return $data;
    }

    /**
     * Comentario cambios
     */
}
