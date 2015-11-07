<?php

namespace App\Http\Controllers;

use App\model\infoRecibos;
use App\model\Iva2;
use App\model\Parcela;
use App\model\Tm_nichos;
use App\model\Tm_parcelas;
use App\model\Tramada;
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

    public function imprimirFacturamanteniminentoNicho($id){

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

    /*
     * Para visualizar mantemientoParcela
     */
    public function pdfmantenimientoParcela($id){

        //Buscamos el id de la factura generada mediante el modulo de recibo
        $factura = Factura::find($id);

        //Buscamos la parcela
        $parcela = infoRecibos::where('idnicho', '=', $factura->idpacerla)->get()[0];

        //Buscamos el precio de mantenimiento de la parcela en tarifas que depende del tipo de nicho
        //si está construido o no, para saberlo comprobamos si tiene alguna tramada
        $tramadas = Tramada::where('GC_PARCELA_id', '=' , $parcela->idparcela)->get();

        //si tiene tramadas está construida por lo tanto tarifa 2
        if(count($tramadas) > 0){
            $tarifa = Tm_parcelas::find(2);
            //obtenemos el nº de nichos de una tramada y todas las demas van a ser igual.
            $precio = (count($tramadas) * $tramadas[0]->nichos) * $tarifa->tarifa ;
        }else{
        //Sino la tarifa 1
            $tarifa = Tm_nichos::find(1);
            //obtenemos el tamanyo de la parcela
            $tamanyio = Parcela::find($parcela->idparcela)->tamanyo;
            $precio = $tarifa->tarifa * $tamanyio;
        }

        //Buscamos el iva configurado
        $iva = Iva2::first();

        $view =  \View::make('pdf.pdfmantenimiento', compact('factura','parcela','precio','iva'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('recibo.pdf', array( 'Attachment'=>1 ));

    }



}
