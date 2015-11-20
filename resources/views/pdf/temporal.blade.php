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

<table class="table1" style="width:90%; font-size: 15px" border="0">
    <tr>
        <td valign="top">
            <span>Factura nº: </span> <span style="margin-left: 1%"> {{$f->serie}}{{str_repeat("0", $aux)}}{{$f->numero}}-{{$ejercicio->year}}</span>
            </span>
            <br>
            <span>Fecha: </span><span style="margin-left: 20%">{{$date}}</span>
        </td>
        <td>
            <div style="margin-left: 20px; margin-top: 4%">
                <span style="margin-left: -20%">Datos de la parcela:</span>
                <br>
                <span>{{$f->nombre_titular}}</span>
                <br>
                <span>Calle: </span>{{$f->calle}}
                <br>
                <span>Numero: </span> {{$f->numero_nicho}}
                <br>
                <span> Altura: {{$f->tramada}}</span>
                <br>
            </div>
        </td>
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
    </tr>

</table>

<br>
<br>
<div style="margin-left: 10%">
    <table class="table2" width="90%" border="1" style="border-collapse: collapse; border: none;  text-align: center" cellspacing="0" cellpadding="0">
    <thead>
    <tr style="font-size: 14px; text-align: left">
        <th>Código</th>
        <th>Concepto</th>
        <th>Cantidad</th>
        <th>Precio</th>
    </tr>

    <tr>

        <td class="left">{{$coste->codigo}}</td>
        <td class="left">Cesión temporal de {{substr($f->inicio,0,4)}} a {{substr($f->fin,0,4)}}</td>
        <td class="left">1</td>
        <td class="right">{{ number_format($coste->tarifa,2,",","")}}{{" € "}}</td>
    </tr>


    <tr class="right">

        <td class="noborder"></td>
        <td class="noborder" ></td>
        <td class="noborder">Base</td>
        <td style="font-weight: bold">{{ number_format($coste->tarifa,2,",","")}}{{" € "}}</td>
    </tr>

    <tr class="right">

        <td class="noborder"></td>
        <td class="noborder"></td>
        <td class="noborder">IVA {{$iva->tipo}} {{" %"}}</td>
        <td>{{ number_format($coste->tarifa * ($iva->tipo/100),2,",","")}}{{" € "}}</td>
    </tr>

    <tr class="right">

        <td class="noborder"></td>
        <td class="noborder"></td>
        <td class="noborder">TOTAL FACTURA</td>
        <td style="font-weight: bold">{{ number_format($coste->tarifa + ($coste->tarifa * ($iva->tipo/100)),2,",","")}}{{" €"}}</td>
    </tr>
    </thead>
</table>
</div>

</body>
</html>