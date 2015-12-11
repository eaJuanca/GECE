<?php

namespace App\Http\Controllers;

use App\model\Factura;
use App\model\InfoNicho;
use App\model\Iva2;
use App\model\Nicho;
use App\model\Tcp_nichos;
use App\model\Tcp_parcelas2;
use App\model\Tct_nichos;
use App\model\Titular;
use App\model\Tramada;
use App\model\VFacturasnp2;
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


        $f = Factura::find($id);

        $tr = $f->tramada;
        $coste = Tcp_nichos::find($tr);
        $iva = Iva2::first();


        $view =  \View::make('pdf.pdfcesion', compact('f','coste','iva'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('invoice.pdf', array( 'Attachment'=>1 ));

    }

    /**
     * Para visualiza la factura de cesion de parcela
     * @param $id de la parcela cuya factura de venta hay que imprimir
     * @return mixed
     */
    public function facturaParcela($id){

        $factura = Factura::find($id);
        $coste = Tcp_parcelas2::find(0);
        $iva = Iva2::first();

        $view =  \View::make('pdf.pdfcesionparcela', compact('factura','coste','iva'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('invoice.pdf', array( 'Attachment'=>1 ));

    }

    /**
     * Para imprimir la facatura sin visualizarla.
     * @param $id de la parcela cuya factura de venta hay que imprimir
     * @return mixed
     */
    public function ifacturaParcela($id){

        $f = VFacturasP::find($id);
        $coste = Tcp_parcelas2::find(0);
        $iva = Iva2::find(1);


        $view =  \View::make('pdf.pdfcesionparcela', compact('f','coste','iva'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->download('recibo.pdf');
    }


    public function facturaTemporal($id){


        $f = Factura::find($id);

        $coste = Tct_nichos::first();
        $iva = Iva2::first();

        $view =  \View::make('pdf.temporal', compact('f','coste','iva'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('invoice.pdf', array( 'Attachment'=>1 ));

    }

    public function facturaEnterramiento($id){

        $f = Factura::find($id);

        $tramada = null;

        $lineas = VLinea::where('factura',$id)->get();
        $iva = Iva2::first();

        if($f->idparcela != null){
            //si es una parcela obtenemos el id de la tramada
            $nicho = Nicho::find($f->idnicho);
            $numero = $nicho->numero;
            $tramada = Tramada::find($nicho->GC_Tramada_id)->tramada;
        }else{
            $tramada = $f->tramada;
            $numero = $f->numero_nicho;
        }

        $view =  \View::make('pdf.enterramiento', compact('f','lineas','iva','tramada','numero'))->render();
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

    public function facturaPersonalizada($id){

        $f = Factura::find($id);

        $tramada = null;

        $lineas = VLinea::where('factura',$id)->get();
        $iva = Iva2::first();

        if($f->idparcela != null){
            //si es una parcela obtenemos el id de la tramada
            $nicho = Nicho::find($f->idnicho);
            $numero = $nicho->numero;
            $tramada = Tramada::find($nicho->GC_Tramada_id)->tramada;
        }else{
            $tramada = $f->tramada;
            $numero = $f->numero_nicho;
        }

        $view =  \View::make('pdf.personalizada', compact('f','lineas','iva','tramada','numero'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('invoice.pdf', array( 'Attachment'=>1 ));
    }

    public function escrituraNicho ($id){

        $nicho = Nicho::find($id); //voluntades y otras cosas
        $info = InfoNicho::find($id); // nombre calle, numero, altura
        $titular = Titular::find($nicho->GC_TITULAR_id); //datos del titular

        $view =  \View::make('pdf.escritura', compact('nicho','titular','info'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('invoice.pdf', array( 'Attachment'=>1 ));
    }

    public function escrituraParcela ($id){

        //hay que obtener los datos de la parcela como arriba pero en vez de nicho

        $view =  \View::make('pdf.escritura', compact('nicho','titular','info'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('invoice.pdf', array( 'Attachment'=>1 ));
    }

    /**
     * Detectar cambios
     */
}
