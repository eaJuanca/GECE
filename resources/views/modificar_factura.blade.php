@extends('master')

@section('title')

    <h2 style="color: white; font-weight: bold; margin-left:10px; ">Editar factura </h2>
@endsection

@section('css')

    <link href="{{ URL::asset('assets/css/nuestros.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('datepickersandbox/css/bootstrap-datepicker3.min.css') }}">


    <style>

        a:hover{
            cursor: pointer;
        }
        span{
            font-weight: bold;

        }
    </style>

@endsection

@section('contenido')

    <br>
    <div class="row" style="margin-top: 1%">

        <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <div class="panel panel-info">

                <?php

                $aux = $f->numero;
                $aux = strlen($aux);
                $aux = 5- $aux;
                ?>
                <div class="panel-heading"><span style="font-weight: bold">Factura {{$f->serie}}{{str_repeat("0", $aux)}}{{$f->numero}}-{{substr($f->inicio,0,4)}}  </span>
                </div>
                <div class="panel-body">



                    <div class="row">
                        <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="col col-lg-4 col-md-4 col-sm-12 col-xs-12"><span>Factura nº: </span> {{$f->serie}}{{str_repeat("0", $aux)}}{{$f->numero}}-{{substr($f->inicio,0,4)}} <br> <span>Fecha:</span> {{$f->inicio}} </div>
                            <div class="col col-lg-4 col-md-4 col-sm-12 col-xs-12"><span>Datos del nicho</span> <br> <span>Titular: </span> {{$f->nombre_titular}}<br> <span>Calle: </span> {{$f->calle}}<span> <br>Numero: </span> {{$f->nicho_numero}}<span> <br>Tramada: </span> {{$f->tramada}}<br> <br> <span>Difunto: </span> {{$f->nom_difunto}}</div>
                            <div class="col col-lg-4 col-md-4 col-sm-12 col-xs-12"><span>Datos de facturación </span><br><span>Nombre y apellidos: </span> {{$f->nom_facturado}} <br><span>NIF/CIF: </span> {{$f->nif_facturado}}<br><span>Domicilio: </span> {{$f->dir_facturado}}</div>
                        </div>
                        <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
                        <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
                        <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
                        <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('jquery')


@endsection
