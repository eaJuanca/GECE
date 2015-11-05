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

    tr td:last-child {
        width: 1%;
        white-space: nowrap;
    }

</style>
<body>

<img src="{{ URL::asset('assets/cruz.gif') }}" height="38" width="32">
<br>
<br>

<h1 style="font-size: 18px; text-align: center; margin-left: -12.5% "> Cementerio Eclesiástico de la Purísima
    Concepción</h1><br>

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
?>

<table style="width:90%" border="0">
    <tr>
        <td valign="top">Fctura nº: {{$f->serie}}{{str_repeat("0", $aux)}}{{$f->numero}}-{{substr($f->inicio,0,4)}} <br>Fecha: {{$date}}
        </td>
        <td valign="top"><br>Datos del nicho <br><br> {{$f->nom_facturado}} <br> <span>Calle: </span>{{$f->calle}}<span> <br>Numero: </span> {{$f->nicho_numero}}
            <span> <br>Tramada: </span> {{$f->tramada}}<br></td>
        <td valign="top">Datos de facturación<br> <br><span>Nombre: </span> {{$f->nom_facturado}}
            <br><span>NIF/CIF: </span> {{$f->nif_facturado}}<br><span>Domicilio: </span> {{$f->dir_facturado}}
            <br> {{$f->cp_facturado}}<br>{{$f->pob_facturado}}/{{$f->pro_facturado}}</td>
    </tr>

</table>

<br>
<br>
<table width="90%" border="1">
    <thead>
    <tr>
        <th>Código</th>
        <th>Concepto</th>
        <th>Cantidad</th>
        <th>Precio</th>
    </tr>

    <tr>

        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    </thead>
</table>


</body>
</html>