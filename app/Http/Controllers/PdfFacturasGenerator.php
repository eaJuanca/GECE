<?php

namespace App\Http\Controllers;

use App\model\Factura;
use App\model\Iva2;
use App\model\TarifaServicios;
use App\model\Tcp_nichos;
use App\model\Tct_nichos;
use App\model\VLinea;
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

    public function facturaTemporal($id){


        $f = VFacturas::find($id);

        $tr = $f->tramada;
        $coste = Tct_nichos::find(0);
        $iva = Iva2::find(1);


        $view =  \View::make('pdf.temporal', compact('f','coste','iva'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('invoice.pdf', array( 'Attachment'=>1 ));

    }

    public function facturaEnterramiento($id){


        $f = VFacturas::find($id);

        $tr = $f->tramada;
        $lineas = VLinea::where('factura',$id)->get();
        $iva = Iva2::find(1);


        $view =  \View::make('pdf.enterramiento', compact('f','lineas','iva'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('invoice.pdf', array( 'Attachment'=>1 ));

    }

    public function orden($id){

        $f = VFacturas::find($id);

        $tr = $f->tramada;
        $lineas = VLinea::where('factura',$id)->get();
        $iva = Iva2::find(1);


        $view =  \View::make('pdf.orden', compact('f','lineas','iva'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('invoice.pdf', array( 'Attachment'=>1 ));
    }

}
