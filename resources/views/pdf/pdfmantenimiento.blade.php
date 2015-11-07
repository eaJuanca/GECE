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
                <h3 style="text-align: center">Grupo/Calle</h3>
                <h3 style="text-align: center">{{$nicho->nicho_calle}}</h3>
            </td>
            <td>
                <h3 style="text-align: center">Nº</h3>
                <h3 style="text-align: center">{{$nicho->nicho_numero}}</h3>
            </td>
            <td>
                <h3 style="text-align: center">Fila</h3>
                <h3 style="text-align: center">{{$nicho->altura}}</h3>
            </td>
    </tr>
</table>

<?php
    //obtenemos la fecha inicio y fin de los años que se pretende pagar
    $inicio = new Carbon\Carbon($factura->inicio);
    $fin = new Carbon\Carbon($factura->fin);
    //calculamos el precio
    $precio = $tarifa->tarifa * ($fin->year - $inicio->year);
    $precio = number_format ( $precio , 2 ,  "," , " " );
?>

<br>

<table style="width:90%" border="1">
    <tr>
        <td>
            <h3 style="text-align: center">Mantenimiento {{$inicio->year}} a {{$fin->year}}</h3>
        </td>
        <td style="text-align: center">
            <h3>{{$precio}}€</h3>
        </td>
    </tr>
</table>

<?php

    $ivaCalculado = $iva->tipo * $precio/100;
?>

<br>

<table style="width:90%" border="1">
    <tr>
        <td>
            <h3 style="text-align: right">IVA {{$iva->tipo}}%</h3>
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
            <h3>{{$precio + $ivaCalculado}}€</h3>
        </td>
    </tr>
</table>

<br>
<p>Titular del nicho efectos informativos</p>
<hr style="width: 100%; margin-right: 10%">
<p>{{$nicho->nombre_titular}}</p>
<p>{{$nicho->nicho_dni}}</p>
<p>{{$nicho->domicilio}}</p>
<p>30510 Yecla (Murcia)</p>
<hr style="width: 100%; margin-right: 10%">


</body>
</html>