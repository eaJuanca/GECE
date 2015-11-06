<?php

namespace App\Http\Controllers;

use App\model\infoRecibos;
use App\model\Iva2;
use App\model\Tm_nichos;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\model\Factura;
use App\Http\Controllers\Controller;

class PdfFacturasGenerator2 extends Controller
{

    public function facturaMantenimientoNicho($id){

        //Buscamos el id de la factura generada mediante el modulo de recibo
        $factura = Factura::find($id);


        //Buscamos el nicho
        $nicho = infoRecibos::where('idnicho', '=', $factura->idnicho)->get()[0];

        //Buscamos el precio de mantenimiento del nicho en tarifas
        $tarifa = Tm_nichos::first();

        //Buscamos el iva configurado
        $iva = Iva2::first();


        $view =  \View::make('pdf.pdfmantenimiento', compact('factura','nicho','tarifa','iva'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('recibo.pdf', array( 'Attachment'=>1 ));

    }

    public function imprimirFacturamanteniminento($id){

        //Buscamos el id de la factura generada mediante el modulo de recibo
        $factura = Factura::find($id);

        //Buscamos el nicho
        $nicho = infoRecibos::where('idnicho', '=', $factura->idnicho)->get()[0];

        //Buscamos el precio de mantenimiento del nicho en tarifas
        $tarifa = Tm_nichos::first();

        //Buscamos el iva configurado
        $iva = Iva2::first();


        $view =  \View::make('pdf.pdfmantenimiento', compact('factura','nicho','tarifa','iva'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->download('recibo.pdf');

    }
}
