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


    .left{
        text-align: left;
    }

    .right{

        text-align: right;
    }

    .noborder{
        border: none;
    }

    .table2 td, .table2 th{
        padding: 2px 5px 2px 5px;
    }

</style>
<body>

<img src="{{ URL::asset('assets/cruz.gif') }}" height="40" width="34">
<br>
<br>
<br>
<img src="{{ URL::asset('harrington.jpg') }}" style="margin-bottom: 10px; margin-left: -42%" width="83%" height="3.5%">
<br>
<br>


<p id="p1">
    CIF: R3000591B <br>
    C/. España, 3 bajo <span style="margin-left: 67%"> 30510 Yecla (Murcia)</span>
</p>
<hr style="width: 100%; margin-right: 10%">

<?php
$aux = $factura->numero;
$aux = strlen($aux);
$aux = 5 - $aux;
?>

<?php

$date = new \Carbon\Carbon($factura->inicio);
$date = $date->format('j/m/Y');
$ejercicio = new \Carbon\Carbon($factura->created_at);

?>

<table class="table1" style="width:90%; font-size: 15px" border="0">
    <tr>
        <td valign="top">
            <span>Factura nº: </span> <span style="margin-left: 1%"> {{$factura->serie}}{{str_repeat("0", $aux)}}{{$factura->numero}}-{{$ejercicio->year}}</span>
            </span>
            <br>
            <span>Fecha: </span><span style="margin-left: 20%">{{$date}}</span>
        </td>
        <td>
            <div style="margin-left: 20px; margin-top: 4%">
                <span style="margin-left: -20%">Datos de la parcela:</span>
                <br>
                <span>{{$factura->nombre_titular}}</span>
                <br>
                <span>Calle: </span>{{$factura->calle}}<span> <br>Numero: </span> {{$factura->parcela}}
                <span> <br>Metros Parcela: {{$factura->metros_parcela}}</span>
                <br>
            </div>
        </td>
        <td valign="top">
            <span style="margin-left: -10%">Datos de facturación:</span>
            <br>
            <span style="font-weight: bold; margin-left: 10%">{{$factura->nombre_facturado}}</span>
            <br>
            <span style="margin-left: 10%">{{$factura->dni_facturado}}</span>
            <br>
            <span style="margin-left: 10%">{{$factura->domicilio_facturado}}</span>
            <br>
            <span style="margin-left: 10%">{{$factura->cp_facturado}}-{{$factura->poblacion_facturado}}-{{$factura->provincia_facturado}}</span>
        </td>
    </tr>

</table>

<br>
<br>
<div style="margin-left: 10%">
<table class="table2" width="90%" border="1" style="border-collapse: collapse; border: none;" cellspacing="0" cellpadding="0">
    <thead>
    <tr style="font-size: 14px; text-align: left">
        <th class="left">Código</th>
        <th class="left">Concepto</th>
        <th class="left ">Cantidad</th>
        <th class="left ">Precio</th>
    </tr>

    <tr class="right">
        <td class="left">{{$coste->codigo}}</td>
        <td class="left">Cesión a perpetuidad</td>
        <td class="left"> {{$factura->metros_parcela}} m2 x {{$coste->tarifa}}€</td>
        <td class="right">{{ number_format($factura->base,2,",","")}}{{" € "}}</td>
    </tr>


    <tr class="right">

        <td class="noborder"></td>
        <td class="noborder"></td>
        <td class="noborder">Base</td>
        <td style="font-weight: bold">{{ number_format($factura->base,2,",","")}}{{" € "}}</td>
    </tr>

    <tr class="right">

        <td class="noborder"></td>
        <td class="noborder"></td>
        <td class="noborder">IVA {{$iva->tipo}} {{" %"}}</td>
            <td style="font-size: 14px">{{ number_format($factura->iva,2,",","") }}{{" € "}}</td>
    </tr>

    <tr class="right">

        <td class="noborder"></td>
        <td class="noborder"></td>
        <td class="noborder">TOTAL FACTURA</td>
        <td style="font-weight: bold">{{ number_format(($factura->base + $factura->iva) ,2,",","")}}{{" €"}}</td>
    </tr>
    </thead>
</table>
</div>


</body>
</html>