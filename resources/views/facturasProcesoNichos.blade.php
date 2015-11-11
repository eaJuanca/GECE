@extends('master')

@section('title')
    <h2 style="color: white; font-weight: bold; margin-left:10px; "> Facturas Rápidas </h2>

    <p class="pull-right"><a href="{{ URL::previous() }}" class="btn btn-md btn-material-orange back fa fa-reply"></a></p>

@endsection

@section('css')

    <link href="{{ URL::asset('assets/css/nuestros.css') }}" rel="stylesheet">

    <style>

        a:hover{
            cursor: pointer;
        }


        .disabled{

            cursor: pointer !important;
        }

        .bold{
            color: white;
            font-size: 12px;
        }


    </style>

@endsection

@section('contenido')

    <div class="row" style="margin-top: 2%">

        <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <div class="panel panel-info" style="margin-top: 20px">
                <div class="panel-heading">
                    <h3 class="panel-title" style="color: white">Facturas generadas en el proceso </h3>
                </div>
                <div class="panel-body">


                        <div class="table-responsive">

                            <table class="table table-bordered table-hover table-condensed">
                                <thead>
                                <tr>
                                    <th>Factura</th>
                                    <th>Nº</th>
                                    <th>Emision</th>
                                    <th>Duración</th>
                                    <th>Acciones</th>

                                </tr>
                                </thead>
                                <tbody class="facturas">


                                @foreach($factura as $f)

                                    <?php

                                    $aux = $f->numero;
                                    $aux = strlen($aux);
                                    $aux = 5- $aux;
                                    ?>


                                    <tr>
                                    @if($f->serie=="N")
                                            <td>Manteminiento Nicho</td>
                                            <td>{{$f->serie}}{{str_repeat("0", $aux)}}{{$f->numero}}-{{substr($f->inicio,0,4)}}</td>
                                            <td>{{$f->inicio}}</td>
                                            <td>{{$f->fin}}</td>
                                             <td> <a href="{{ route('pdfmantenimientoNicho',[$f->id])}}"> <button class="btn btn-danger btn-xs">Descargar</button> </a></td>

                                    @elseif($f->serie=='D')

                                            <td>Cesión a perpetuidad</td>
                                            <td>{{$f->serie}}{{str_repeat("0", $aux)}}{{$f->numero}}-{{substr($f->inicio,0,4)}}</td>
                                            <td>{{$f->inicio}}</td>
                                            <td>-</td>
                                            <td> <a href="{{ route('pdfacturanicho',[$f->id])}}"> <button class="btn btn-danger btn-xs">Descargar</button> </a></td>

                                    @elseif($f->serie=='E')

                                            <td>Enterramiento</td>
                                            <td>{{$f->serie}}{{str_repeat("0", $aux)}}{{$f->numero}}-{{substr($f->inicio,0,4)}}</td>
                                            <td>{{$f->inicio}}</td>
                                            <td>-</td>
                                            <td> <a href="{{ route('pdfacturaenterramiento',[$f->id])}}"> <button class="btn btn-danger btn-xs">Descargar</button> </a> <a href="{{ route('pdforden',[$f->id])}}"> <button class="btn btn-warning btn-xs">Orden <i class="fa fa-male fa-lg"></i></button> </a><a href="{{ route('modificar-factura',[$f->id])}}"> <button class="btn btn-success btn-xs">Modificar</button> </a></td>

                                        @elseif($f->serie=='T')

                                            <td>Cesión Temporal</td>
                                            <td>{{$f->serie}}{{str_repeat("0", $aux)}}{{$f->numero}}-{{substr($f->inicio,0,4)}}</td>
                                            <td>{{$f->inicio}}</td>
                                            <td>-</td>
                                            <td> <a href="{{ route('pdfacturanichotemporal',[$f->id])}}"> <button class="btn btn-danger btn-xs">Descargar</button> </a></td>

                                        @elseif($f->serie=='M')

                                            <td>Mantenimiento Panteon</td>
                                            <td>{{$f->serie}}{{str_repeat("0", $aux)}}{{$f->numero}}-{{substr($f->inicio,0,4)}}</td>
                                            <td>{{$f->inicio}}</td>
                                            <td>{{$f->fin}}</td>
                                            <td> <a href="{{ route('pdfmantenimientoParcela',[$f->id])}}"> <button class="btn btn-danger btn-xs">Descargar</button></a></td>

                                        @elseif($f->serie=='P')

                                            <td>Cesión Panteón</td>
                                            <td>{{$f->serie}}{{str_repeat("0", $aux)}}{{$f->numero}}-{{substr($f->inicio,0,4)}}</td>
                                            <td>{{$f->inicio}}</td>
                                            <td>-</td>
                                            <td> <a href="{{ route('pdfacturaParcela',[$f->id])}}"> <button class="btn btn-danger btn-xs">Descargar</button> </a></td>
                                    @endif
                                    </tr>

                                @endforeach

                                </tbody>
                            </table>
                        </div>


                </div>
            </div>

        </div>
    </div>


@endsection

@section('jquery')


@endsection
