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

    .p1{
        font-size: 11px;
    }
    .p2{
        font-size: 13px;
    }

    table {
        background: #ccc;
        border-spacing: 1px;
    }
    td {
        background: #fff;
    }
    .mia{
        font-size: 17px;
        font-weight: bold;
    }

</style>
<body>

<?php
$aux = $factura->numero;
$aux = strlen($aux);
$aux = 5 - $aux;
?>

<img src="{{ URL::asset('assets/cruz.gif') }}" height="42" width="36">
<br>
<br>
<br>

<img src="{{ URL::asset('harrington.jpg') }}" style="margin-bottom: 10px; margin-left: -45%" width="90%" height="2%">
<br>

<p class="p1">
    CIF: R3000591B <span style="margin-left: 35%">30510 YECLA (Murcia)</span>
</p>
<hr style="width: 100%; margin-right: 10%">
<h5 style="margin-left: 40%; margin-top: -3%; margin-bottom: 0.5%">FACTURA SIMPLIFICADA</h5>

<?php
$hoy = new Carbon\Carbon();
$hoy = $hoy->format('j/m/Y');

$ejercicio = new \Carbon\Carbon($factura->created_at);
?>

<span class="p2">Fecha: {{$hoy}}</span>
<br>
<span class="p2" style="margin-top: -10px">Factura: {{$factura->serie}}/{{str_repeat("0",$aux) . $factura->numero}}/{{$ejercicio->year}} </span>
<hr style="width: 100%; margin-right: 10%">

<span class="p2"> <strong>Concepto</strong></span>
<table style="width:90%;margin-bottom: 0.5%">
    <tr>
        <td style="text-align: center">
            <span class="p2">Grupo/Calle</span>
            <br>
            <span class="mia">{{$factura->calle}}</span>
        <td style="text-align: center">
            <span class="p2">Nº</span>
            <br>
            <span class="mia">{{$factura->parcela}}</span>
        </td >
        <td style="text-align: center">
            @if($tipo == 1)
                <span class="p2">Metros pacela</span>
                <br>
                <span class="mia">{{$factura->metros_parcela}}</span>
            @else
                <span class="p2">Nichos parcela</span>
                <br>
                <span class="mia">{{$numNichos}}</span>
            @endif
        </td>
    </tr>
</table>

<?php
//obtenemos la fecha inicio y fin de los años que se pretende pagar
$inicio = new Carbon\Carbon($factura->inicio);
$fin = new Carbon\Carbon($factura->fin);
?>


<table style="width:90%;margin-bottom: 0.5%">
    <tr>
        <td style="text-align: center">
            <span style="font-size: 16px">Mantenimiento {{$inicio->year}} a {{$fin->year - 1}}</span>
        </td>
        <td style="text-align: right">
            <span style="font-size: 16px">{{number_format($factura->base,2,",","")}}€</span>
        </td>
    </tr>
</table>


<table style="width:90%;margin-bottom: 1.3%">
    <tr>
        <td style="text-align: right">
            <span style="font-size: 12.5px">IVA {{$iva}}%</span>
        </td>
        <td style="text-align: right">
            <span style="font-size: 12.5px">{{number_format($factura->iva,2,",","")}}€</span>
        </td>
    </tr>
    <tr>
        <td style="text-align: right">
            <span class="mia">TOTAL</span>
        </td>
        <td style="text-align: right">
            <span class="mia">{{number_format(($factura->iva + $factura->base),2,",","")}}€</span>
        </td>
    </tr>
</table>

<span class="p2">Titular del nicho efectos informativos</span   >
<hr style="width: 100%; margin-right: 10%">
<span style="font-size: 13px; font-weight: bold">{{$factura->nombre_titular}}</span>
<br>
<span style="font-size: 13px">{{$factura->dni_titular}}</span>
<br>
<span style="font-size: 13px">{{$factura->domicilio_del_titular}}</span>
<br>
<span style="font-size: 13px">30510 Yecla (Murcia)</span>
<hr style="width: 100%; margin-right: 10%">


</body>
</html>