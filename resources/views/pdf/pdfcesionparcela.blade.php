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

<img src="{{ URL::asset('assets/cruz.gif') }}" height="38" width="32">
<br>
<br>

<img src="{{ URL::asset('harrington.jpg') }}" style="margin-bottom: 10px; margin-left: -44%">
<br>
<br>
<br>

<p id="p1">
    CIF: R3000591B <br>
    C/. España, 3 bajo 30510 <span style="margin-left: 60%">Yecla (Murcia)</span>
</p>
<hr style="width: 100%; margin-right: 10%">

<?php
$aux = $factura->numero;
$aux = strlen($aux);
$aux = 5 - $aux;
?>

<?php

$date = new \Carbon\Carbon($factura->inicio);
$date = $date->format('j-m-Y');
$ejercicio = new \Carbon\Carbon($factura->created_at);

?>

<table class="table1" style="width:90%" border="0">
    <tr>
        <td valign="top">Factura nº: {{$factura->serie}}{{str_repeat("0", $aux)}}{{$factura->numero}}-{{$ejercicio->year}} <br>Fecha: {{$date}}
        </td>
        <td valign="top">
            <div style="margin-left: 20px">
                <br>Datos de la parcela <br><br> {{$factura->nombre_titular}}<br>
                <span>Calle: </span>{{$factura->calle}}<span> <br>Numero: </span> {{$factura->parcela}}
                <span> <br>Metros Parcela: {{$factura->metros_parcela}}</span>
                <br>
            </div>
        </td>
        <td valign="top">Datos de facturación<br> <br><span>Nombre: </span> {{$factura->nombre_facturado}}
            <br><span>NIF/CIF: </span> {{$factura->dni_facturado}}<br><span>Domicilio: </span> {{$factura->domicilio_facturado}}
            <br> {{$factura->cp_facturado}}<br>{{$factura->poblacion_facturado}}/{{$factura->provincia_facturado}}</td>
    </tr>

</table>

<br>
<br>
<table class="table2" width="90%" border="1" style="border-collapse: collapse; border: none;  text-align: center" cellspacing="0" cellpadding="0">
    <thead>
    <tr style="font-size: 18px; background-color: #00BCD4">
        <th>Código</th>
        <th>Concepto</th>
        <th>Cantidad</th>
        <th>Precio</th>
    </tr>

    <tr>
        <td class="left"></td>
        <td class="left">Cesión a perpetuidad</td>
        <td class="left"> {{$factura->metros_parcela}} m2 x {{$coste->tarifa}}€</td>
        <td class="right">{{ number_format($factura->base,2)}}{{" € "}}</td>
    </tr>


    <tr class="right">

        <td class="noborder"></td>
        <td class="noborder" ></td>
        <td class="noborder">Base</td>
        <td>{{ number_format($factura->base,2)}}{{" € "}}</td>
    </tr>

    <tr class="right">

        <td class="noborder"></td>
        <td class="noborder"></td>
        <td class="noborder">IVA {{$iva->tipo}} {{" %"}}</td>
        <td>{{ number_format($factura->iva,2)}}{{" € "}}</td>
    </tr>

    <tr class="right">

        <td class="noborder"></td>
        <td class="noborder"></td>
        <td class="noborder">TOTAL FACTURA</td>
        <td>{{ number_format(($factura->base + $factura->iva) ,2)}}{{" €"}}</td>
    </tr>
    </thead>
</table>


</body>
</html>