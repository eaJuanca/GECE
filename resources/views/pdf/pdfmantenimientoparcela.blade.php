<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Factura cesion perpetuidad</title>

</head>

<style>

    html, body{

        width: 9cm;
        height: 29.7cm;
    }

    img{
        position: absolute;
        left: 45%;
        margin-left: -16px;
    }

    #p1{
        font-size: 11px;
    }

</style>
<body>

<img src="{{ URL::asset('assets/cruz.gif') }}" height="42" width="36">
<br>
<br>

<h2 style="font-size: 18px; text-align: center; margin-left: -12.5% "> Cementerio Eclesiástico de la Purísima Concepción</h2>
<p style="font-size: 15px; text-align: center; margin-left: -12.5% "> Yecla</p>

<p id="p1">
    CIF: R3000591B <span style="margin-left: 45%">Yecla (Murcia)</span>
</p>
<hr style="width: 100%; margin-right: 10%">
<h3 style="margin-left: 20%; margin-top: -3%">FACTURA SIMPLIFICADA</h3>

<?php
$hoy = new Carbon\Carbon();
$hoy = $hoy->format('j-m-Y');

$ejercicio = new \Carbon\Carbon($factura->created_at);
?>

<p>Fecha: {{$hoy}}</p>
<p style="margin-top: -5px">Factura: {{$factura->serie}}/{{$factura->numero}}/{{$ejercicio->year}} </p>
<hr style="width: 100%; margin-right: 10%">

<p>Concepto</p>
<table style="width:90%" border="1">
    <tr>
        <td>
            <h4 style="text-align: center">Grupo/Calle</h4>
            <h4 style="text-align: center">{{$parcela->parcela_calle}}</h4>
        </td>
        <td>
            <h4 style="text-align: center">Nº</h4>
            <h4 style="text-align: center">{{$parcela->parcela_numero}}</h4>
        </td>
        <td>
            @if($tipo == 1)
                <h4 style="text-align: center">Metros pacela</h4>
                <h4 style="text-align: center">{{$tamanyio}}</h4>
            @else
                <h4 style="text-align: center">Nichos parcela</h4>
                <h4 style="text-align: center">{{$numNichos}}</h4>
            @endif
        </td>
    </tr>
</table>

<?php
//obtenemos la fecha inicio y fin de los años que se pretende pagar
$inicio = new Carbon\Carbon($factura->inicio);
$fin = new Carbon\Carbon($factura->fin);
?>

<br>

<table style="width:90%" border="1">
    <tr>
        <td>
            <h4 style="text-align: center">Mantenimiento {{$inicio->year}} a {{$fin->year}}</h4>
        </td>
        <td style="text-align: center">
            <h3>{{$factura->base}}€</h3>
        </td>
    </tr>
</table>

<?php

$ivaCalculado = $factura->iva * $factura->base/100;
?>

<br>

<table style="width:90%" border="1">
    <tr>
        <td>
            <h3 style="text-align: right">IVA {{$factura->iva}}%</h3>
        </td>
        <td style="text-align: center">
            <h3>{{$ivaCalculado}}€</h3>
        </td>
    </tr>
    <tr>
        <td style="text-align: right">
            <h3>TOTAL</h3>
        </td>
        <td style="text-align: center">
            <h3>{{$factura->base + $ivaCalculado}}€</h3>
        </td>
    </tr>
</table>

<br>
<p>Titular de la pacela efectos informativos</p>
<hr style="width: 100%; margin-right: 10%">
<p>{{$parcela->panteon_titular}}</p>
<p>{{$parcela->parcela_dni}}</p>
<p>{{$parcela->domicilio}}</p>
<p>30510 Yecla (Murcia)</p>
<hr style="width: 100%; margin-right: 10%">


</body>
</html>