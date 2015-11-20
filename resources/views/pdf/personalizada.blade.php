<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Factura cesion perpetuidad</title>

</head>

<style>

    html, body {

        width: 21cm;
        height: 29.7cm;
    }

    img {
        position: absolute;
        left: 45%;
        margin-left: -16px;
    }
    #p1 {


        font-size: 11px;
    }

    .table1 tr td:first-child {
        width: 1%;
        white-space: nowrap;
    }


    .left {
        text-align: left;
        font-size: 13px;
    }

    .right {

        text-align: right;
        font-size: 13px;
    }

    .noborder {
        border: none;
    }

    .table2 td, .table2 th {
        padding: 2px 5px 2px 5px;
    }

    .parte1 {
        height: 15cm;
    }

    hr{
        border: 1px solid darkgray;
    }


</style>
<body>

<div class="parte1">

    <img src="{{ URL::asset('assets/cruz.gif') }}" height="34" width="28">
    <br>
    <br>

    <img src="{{ URL::asset('harrington.jpg') }}" style="margin-bottom: 10px; margin-left: -44%">
    <br>
    <br>
    <br>

    <p id="p1" style="margin-top: 2px">
        CIF: R3000591B <br>
        C/. España, 3 bajo 30510 <span style="margin-left: 60%">Yecla (Murcia)</span>
    </p>
    <hr style="width: 100%; margin-right: 10%">


    <?php

    $aux = $f->numero;
    $aux = strlen($aux);
    $aux = 5 - $aux;
    ?>

    <?php

    $date = new \Carbon\Carbon($f->inicio);
    $date = $date->format('j-m-Y');
    $ejercicio = new \Carbon\Carbon($f->created_at);
    ?>

    <table class="table1" style="width:90%; font-size: 14px" border="0">
        <tr>
            <td valign="top">
                <span>Factura nº: </span> <span style="margin-left: 1%"> {{$f->serie}}{{str_repeat("0", $aux)}}{{$f->numero}}-{{$ejercicio->year}}</span>
                </span>
                <br>
                <span>Fecha: </span><span style="margin-left: 20%">{{$date}}</span>
            </td>
            <td valign="top">
                <div style="margin-left: 20px">
                @if($f->idparcela == null)
                    <br> <b>Datos del nicho</b>
                @else
                    <br> <b>Datos de la parcela </b>
                @endif
                <br> {{$f->nom_facturado}} <br>
                <span> <b>Calle: </b> </span>{{$f->calle}}
                @if($f->idparcela != null)
                    <span> <br> <b>Parcela:</b> </span> {{$f->parcela}}
                @endif
                    <span> <br> <b>Altura: </b> </span> {{$tramada}}
                @if($f->idparcela != null)
                    <span> <br> <b>Número: </b> </span> {{$numero}}
                @else
                    <span> <br> <b>Número:</b> </span> {{$numero}}
                @endif
                    <br><br>{{$f->nombre_difunto}}
                </div></td>
            <td valign="top">
                <span style="margin-left: -10%">Datos de facturación:</span>
                <br>
                <span style="font-weight: bold; margin-left: 10%">{{$f->nombre_facturado}}</span>
                <br>
                <span style="margin-left: 10%">{{$f->dni_facturado}}</span>
                <br>
                <span style="margin-left: 10%">{{$f->domicilio_facturado}}</span>
                <br>
                <span style="margin-left: 10%">{{$f->cp_facturado}}-{{$f->poblacion_facturado}}-{{$f->provincia_facturado}}</span>
            </td>

    </table>

    <br>
    <br>

    <div style="margin-left: 10%">
        <table class="table2" width="90%" border="1" style="border-collapse: collapse; border: none;  text-align: center"
           cellspacing="0" cellpadding="0">
        <thead>
        <tr style="font-size: 13px; text-align: left">
            <th>Código</th>
            <th>Concepto</th>
            <th>Cantidad</th>
            <th>Precio</th>
        </tr>


        <?php $total = 0; ?>

        @foreach($lineas as $linea)
            <tr>

                <td class="left">{{$linea->codigo}}</td>
                <td class="left">{{$linea->concepto}}</td>
                <td class="left">{{$linea->cantidad}}</td>
                <td class="right">{{ number_format($linea->importe * $linea->cantidad,2,",","")}}{{" € "}}</td>
                <?php $total += $linea->importe * $linea->cantidad ?>
            </tr>
        @endforeach


        <tr class="right">

            <td class="noborder"></td>
            <td class="noborder"></td>
            <td class="noborder">Base</td>
            <td style="font-weight: bold">{{ number_format($total,2,",","")}}{{" € "}}</td>
        </tr>

        <tr class="right">

            <td class="noborder"></td>
            <td class="noborder"></td>
            <td class="noborder">IVA {{$iva->tipo}} {{" %"}}</td>
            <td>{{ number_format($total * ($iva->tipo/100),2,",","")}}{{" € "}}</td>
        </tr>

        <tr class="right">

            <td class="noborder"></td>
            <td class="noborder"></td>
            <td class="noborder">TOTAL FACTURA</td>
            <td style="font-weight: bold">{{ number_format($total + ($total * ($iva->tipo/100)),2,",","")}}{{" €"}}</td>
        </tr>


        </thead>
    </table>
    </div>
</div>

</body>
</html>