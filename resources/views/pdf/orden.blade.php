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

    .table1 tr td:last-child {
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

<div class=".parte1">
    <img src="{{ URL::asset('assets/cruz.gif') }}" height="38" width="32">
    <br>
    <br>

    <h1 style="font-size: 26px; text-align: center; margin-left: -12.5% "> Cementerio Eclesiástico de la Purísima
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

    $date2 = new \Carbon\Carbon(substr($f->created_at,0,10));
    $date2 = $date2->format('j-m-Y');
    ?>

    <table class="table1" style="width:90%" border="0" width="95%">
        <tr >
            <td valign="top"> <div>Nº: {{$f->serie}}{{str_repeat("0", $aux)}}{{$f->numero}}-{{substr($f->inicio,0,4)}}</div> </td>
        </tr>

        <tr>
            <td>  <div style="margin-left: 35%"><h1>Orden de trabajo</h1>  </div></td>
        </tr>

    </table>

    <br>
    <br>
    <table class="table2" width="90%" border="1" style="border-collapse: collapse; border: none;  text-align: center" cellspacing="0" cellpadding="0">
        <thead>
        <tr style="font-size: 18px; background-color: #00BCD4">
            <th>Código</th>
            <th>Concepto</th>
        </tr>



        @foreach($lineas as $linea)
            <tr>

                <td class="left">{{$linea->codigo}}</td>
                <td class="left">{{$linea->concepto}}</td>
            </tr>
        @endforeach



        </thead>
    </table>


    <br>
    <br>
    <table>

        <tbody>

        <tr class="left">
            <td width="20%"><span>            </span></td>
            <td class="noborder">Difunto: {{$f->nom_difunto}} </td>
            <td></td>

        </tr><tr class="left">
            <td></td>
            <td class="noborder">Nicho numero: {{$f->nicho_numero}} </td>
            <td></td>

        </tr>

        <tr class="left">
            <td></td>
            <td class="noborder">Fila: {{$f->tramada}} </td>
            <td></td>

        </tr>

        <tr class="left">
            <td></td>
            <td class="noborder">Grupo/Calle: {{$f->calle}} </td>
            <td></td>

        </tr>

        <tr class="left">
            <td></td>
            <td class="noborder">cuyo nicho es:</td>
            <td></td>

        </tr>
        </tbody>
    </table>

    <H4 style="text-align: right; width: 80%">Yecla {{$date2}}</H4>

    <h3>Sr. Sepulturero del Cementerio Eclesiástico de la Purísima Concepción de Yecla</h3>

</div>

</body>
</html>