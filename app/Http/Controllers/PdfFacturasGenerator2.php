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

        $view =  \View::make('pdf.pdfmantenimiento', compact('factura','nicho'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('recibo.pdf', array( 'Attachment'=>1 ));

    }

    public function imprimirFacturamanteniminentoNicho($id){

        //Buscamos el id de la factura generada mediante el modulo de recibo
        $factura = Factura::find($id);

        //Buscamos el nicho
        $nicho = infoRecibos::where('idnicho', '=', $factura->idnicho)->get()[0];

        $view =  \View::make('pdf.pdfmantenimiento', compact('factura','nicho'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->download('recibo.pdf');

    }

    /*
     * Para visualizar mantemientoParcela
     */
    public function facturaMantenimientoParcela($id){

        $numNichos = null;
        //Buscamos el id de la factura generada mediante el modulo de recibo
        $factura = Factura::find($id);

        //Buscamos la parcela
        $parcela = infoRecibos::where('idparcela', '=', $factura->idparcela)->get()[0];

        //Buscamos el precio de mantenimiento de la parcela en tarifas que depende del tipo de nicho
        //si está construido o no, para saberlo comprobamos si tiene alguna tramada
        $tramadas = Tramada::where('GC_PARCELA_id', '=' , $parcela->idparcela)->get();

        //si tiene tramadas está construida por lo tanto tarifa 2
        if(count($tramadas) > 0){
            $numNichos = count($tramadas) * $tramadas[0]->nichos;
        }else{
        //Sino la tarifa 1
            $tipo = 1;
            $tamanyio = Parcela::find($parcela->idparcela)->tamanyo;
        }

        $view =  \View::make('pdf.pdfmantenimientoparcela', compact('factura','parcela','tamanyio','tipo','numNichos'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('recibo.pdf', array( 'Attachment'=>1 ));

    }

    /**
     * Imprimir factura mantenimiento de la parcela
     * @param $id
     * @return mixed
     */
    public function ifacturaMantenimientoParcela($id){

        $numNichos = null;
        //Buscamos el id de la factura generada mediante el modulo de recibo
        $factura = Factura::find($id);

        //Buscamos la parcela
        $parcela = infoRecibos::where('idparcela', '=', $factura->idparcela)->get()[0];

        //Buscamos el precio de mantenimiento de la parcela en tarifas que depende del tipo de nicho
        //si está construido o no, para saberlo comprobamos si tiene alguna tramada
        $tramadas = Tramada::where('GC_PARCELA_id', '=' , $parcela->idparcela)->get();

        //si tiene tramadas está construida por lo tanto tarifa 2
        if(count($tramadas) > 0){
            $numNichos = count($tramadas) * $tramadas[0]->nichos;
        }else{
            //Sino la tarifa 1
            $tipo = 1;
            $tamanyio = Parcela::find($parcela->idparcela)->tamanyo;
        }

        $view =  \View::make('pdf.pdfmantenimientoparcela', compact('factura','parcela','tamanyio','tipo','numNichos'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->download('recibo.pdf', array( 'Attachment'=>1 ));

    }



}
