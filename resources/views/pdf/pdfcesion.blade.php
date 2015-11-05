<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Factura cesion perpetuidad</title>

</head>

<style>

    html, body{

        width: 21cm;
        height: 29.7cm;
    }

    img{
        position: absolute;
        left: 50%;
        margin-left: -16px;
    }

</style>
<body>

<img src="{{ URL::asset('assets/cruz.gif') }}" height="38" width="32">
<br>
<br>

<h1 style="font-size: 18px; text-align: center "> Cementerio Eclesiástico de la Purísima Concepción</h1>
<p id="p1">
    CIF: R3000591B <br>
    C/. España, 3 bajo 30510 <span style="margin-left: 55%">Yecla (Murcia)</span>
</p>
<hr style="width: 100%; margin-right: 10%">

<?php

$aux = $f->numero;
$aux = strlen($aux);
$aux = 5- $aux;
?>

<?php

$date = new \Carbon\Carbon($f->inicio);
$date = $date->format('j-m-Y');
?>

<table style="width:90%" border="1">
    <tr>
        <td>Fctura nº: {{$f->serie}}{{str_repeat("0", $aux)}}{{$f->numero}}-{{substr($f->inicio,0,4)}} <br>Fecha: {{$date}} </td>
        <td><br><br>Datos del nicho</td>
        <td>Datos de facturación</td>
    </tr>

</table>


</body>
</html>