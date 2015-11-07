<?php

namespace App\Http\Controllers;

use App\model\Factura;
use App\model\Iva2;
use App\model\TarifaServicios;
use App\model\Tcp_nichos;
use App\model\Tcp_parcelas2;
use App\model\Tct_nichos;
use App\model\VLinea;
use App\Http\Requests;
use App\model\VFacturas;
use App\model\VFacturasP;

class PdfFacturasGenerator extends Controller
{

    /**
     * @param $id del nicho cuya factura de venta hay que imprimir
     * @return mixed
     */
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

    /**
     * @param $id de la parcela cuya factura de venta hay que imprimir
     * @return mixed
     */
    public function facturaParcela($id){

        $f = VFacturasP::find($id);
        $coste = Tcp_parcelas2::find(0);
        $iva = Iva2::find(1);


        $view =  \View::make('pdf.pdfcesionparcela', compact('f','coste','iva'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('invoice.pdf', array( 'Attachment'=>1 ));

    }


    public function facturaTemporal($id){


        $f = VFacturas::find($id);

        $coste = Tct_nichos::find(0);
        $iva = Iva2::find(1);


        $view =  \View::make('pdf.temporal', compact('f','coste','iva'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('invoice.pdf', array( 'Attachment'=>1 ));

    }

    public function facturaEnterramiento($id){


        $f = VFacturas::find($id);

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
