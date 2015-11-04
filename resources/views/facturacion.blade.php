@extends('master')

@section('title')

    <h2 style="color: white; font-weight: bold; margin-left:10px; "> Facturación </h2>
    <p class="pull-right"><a href="{{ URL::route('home') }}" class="btn btn-md btn-material-orange back glyphicon glyphicon glyphicon-arrow-left"></a></p>

@endsection


@section('css')

    <link href="{{ URL::asset('assets/css/nuestros.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('datepickersandbox/css/bootstrap-datepicker3.min.css') }}">

@endsection

@section('contenido')


    <div class="panel panel-info" style="margin-top: 20px">
        <div class="panel-heading">
            <h3 class="panel-title" style="color: white">Búsqueda</h3>
        </div>
        <div class="panel-body">

            <form method="POST" action="{{URL::route('busquedaFacturas')}}">

                <div class="row">
                    <section class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">


                        <div class="row">
                            <div  id="titular" class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Nombre de titular</label>
                                    <input type="text" class="form-control" name="titular" value="<?php if(isset($titular)) echo $titular; else $titular=''; ?>">
                                </div>
                            </div>

                            <div id="difunto" class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Nombre del difunto</label>
                                    <input type="text" class="form-control"  name="difunto" value="<?php if(isset($difunto)) echo $difunto; else $difunto=''; ?>">
                                </div>
                            </div>

                        </div>


                        <div class="row">

                            <div  id="dnibuscar" class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Dni</label>
                                    <input type="text" class="form-control" name="dni" value="<?php if(isset($dni)) echo $dni; else $dni=''; ?>">
                                </div>
                            </div>

                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Calle Nicho</label>
                                    <input type="text" class="form-control" name="calle" value="<?php if(isset($calle)) echo $calle;  else $calle='';?>">
                                </div>
                            </div>
                            </div>
                        <div class="row">

                            <div class="col col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Fecha desde</label>
                                    <input type="text" class="form-control fecha" name="desde" value="<?php if(isset($desde)) echo $desde; else $desde=''; ?>">
                                </div>
                            </div>

                            <div class="col col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Fecha hasta</label>
                                    <input type="text" class="form-control fecha"  name="hasta" value="<?php if(isset($hasta)) echo $hasta; else $hasta=''; ?>">
                                </div>
                            </div>

                            <div class="col col-lg-4 col-md-2 col-sm-12 col-xs-12  message">

                                @if($search)
                                    <div class="form-group">

                                        <br>
                                        <br>
                                        <span  style="font-weight: bold; color: orangered;" > Estas en modo busqueda, pulse para terminar <i  style="color: black" class="fa fa-hand-o-right fa-2x"></i> </span>
                                    </div>
                                @endif
                            </div>


                            <div class="col col-lg-2 col-md-2 col-sm-12 col-xs-12 message">

                                @if($search)
                                <div class="form-group">
                                    <br>
                                    <a  href="{{ URL::route('facturacion') }}"><button style="font-size: 14px!important;" type="button" class="btn btn-warning btn-xs">Terminar Busqueda</button></a>
                                </div>
                                    @endif
                            </div>


                            <div class="col col-lg-2 col-md-2 col-sm-12 col-xs-12 pull-right">
                                <div class="form-group">
                                    <br>
                                    <button type="submit" style="font-size: 14px!important;" class="btn btn-primary btn-raised btn-xs">Buscar</button>
                                </div>
                            </div>

                        </div>

                    </section>
                </div>
            </form>

        </div>
    </div>

    <div class="row" style="margin-top: 1%">

        <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <div class="panel panel-info">
                <div class="panel-heading"><span style="color: white">Resultados</span>
                </div>
                <div class="panel-body">
                    <div class="table-responsive render">

                        <table class="table table-bordered table-hover table-condensed" cellspacing="10" cellpadding="10">
                            <thead>
                            <tr>
                                <th>Factura</th>
                                <th>Nº</th>
                                <th>Emision</th>
                                <th>Duración</th>
                                <th>Titular</th>
                                <th>Dni</th>
                                <th>Acciones</th>

                            </tr>
                            </thead>
                            <tbody class="facturas">


                            @foreach($facturas as $f)

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
                                        <td>{{$f->nombre_titular}}</td>
                                        <td>{{$f->dni_titular}}</td>
                                        <td> <a href="{{ route('pdfacturanicho',[$f->id])}}"> <button class="btn btn-danger btn-xs">ver <i class="fa fa-eye fa-lg"></i></button> </a> <br></td>

                                    @elseif($f->serie=='D')

                                        <td>Cesión a perpetuidad</td>
                                        <td>{{$f->serie}}{{str_repeat("0", $aux)}}{{$f->numero}}-{{substr($f->inicio,0,4)}}</td>
                                        <td>{{$f->inicio}}</td>
                                        <td>{{$f->fin}}</td>
                                        <td>{{$f->nombre_titular}}</td>
                                        <td>{{$f->dni_titular}}</td>
                                        <td> <a href="{{ route('pdfacturanicho',[$f->id])}}"> <button class="btn btn-danger btn-xs">ver <i class="fa fa-eye fa-lg"></i></button> </a> <br></td>

                                    @elseif($f->serie=='E')

                                        <td>Enterramiento</td>
                                        <td>{{$f->serie}}{{str_repeat("0", $aux)}}{{$f->numero}}-{{substr($f->inicio,0,4)}}</td>
                                        <td>{{$f->inicio}}</td>
                                        <td>{{$f->fin}}</td>
                                        <td>{{$f->nombre_titular}}</td>
                                        <td>{{$f->dni_titular}}</td>
                                        <td> <a href="{{ route('pdfacturanicho',[$f->id])}}"> <button class="btn btn-danger btn-xs">ver <i class="fa fa-eye fa-lg"></i></button> </a><a href="{{ route('pdfacturanicho',[$f->id])}}"> <button class="btn btn-success btn-xs">Modificar</button> </a> <br></td>

                                    @elseif($f->serie=='T')

                                        <td>Cesión Temporal</td>
                                        <td>{{$f->serie}}{{str_repeat("0", $aux)}}{{$f->numero}}-{{substr($f->inicio,0,4)}}</td>
                                        <td>{{$f->inicio}}</td>
                                        <td>{{$f->fin}}</td>
                                        <td>{{$f->nombre_titular}}</td>
                                        <td>{{$f->dni_titular}}</td>
                                        <td> <a href="{{ route('pdfacturanicho',[$f->id])}}"> <button class="btn btn-danger btn-xs">ver <i class="fa fa-eye fa-lg"></i></button> </a><a href="{{ route('pdfacturanicho',[$f->id])}}"> <button class="btn btn-success btn-xs">Modificar</button> </a> <br></td>

                                    @elseif($f->serie=='M')

                                        <td>Mantenimiento Panteon</td>
                                        <td>{{$f->serie}}{{str_repeat("0", $aux)}}{{$f->numero}}-{{substr($f->inicio,0,4)}}</td>
                                        <td>{{$f->inicio}}</td>
                                        <td>{{$f->fin}}</td>
                                        <td>{{$f->nombre_titular}}</td>
                                        <td>{{$f->dni_titular}}</td>
                                        <td> <a href="{{ route('pdfacturanicho',[$f->id])}}"> <button class="btn btn-danger btn-xs">ver <i class="fa fa-eye fa-lg"></i></button></a> <br></td>

                                    @elseif($f->serie=='P')

                                        <td>Cesión Panteón</td>
                                        <td>{{$f->serie}}{{str_repeat("0", $aux)}}{{$f->numero}}-{{substr($f->inicio,0,4)}}</td>
                                        <td>{{$f->inicio}}</td>
                                        <td>{{$f->fin}}</td>
                                        <td>{{$f->nombre_titular}}</td>
                                        <td>{{$f->dni_titular}}</td>
                                        <td> <a href="{{ route('pdfacturanicho',[$f->id])}}"> <button class="btn btn-danger btn-xs">ver <i class="fa fa-eye fa-lg"></i></button></a> <br></td>

                                        @else

                                        <td>??</td>
                                        <td>{{$f->serie}}{{str_repeat("0", $aux)}}{{$f->numero}}-{{substr($f->inicio,0,4)}}</td>
                                        <td>{{$f->inicio}}</td>
                                        <td>{{$f->fin}}</td>
                                        <td>{{$f->nombre_titular}}</td>
                                        <td>{{$f->dni_titular}}</td>
                                        <td> <a href="{{ route('pdfacturanicho',[$f->id])}}"> <button class="btn btn-danger btn-xs">ver <i class="fa fa-eye fa-lg"></i></button></a> <br></td>

                                    @endif
                                </tr>

                            @endforeach


                            </tbody>
                        </table>
                        <div class="pull-right paginacion">
                            {!! $facturas->render() !!}
                        </div>

                    </div>

                </div>


            </div>



        </div>
    </div>


@endsection

@section('js')

    <script type="text/javascript">

        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });

        $('.fecha').datepicker({

            format: "yyyy-mm-dd",
            language: "es",
            multidate: false,
            autoclose: true,
            todayHighlight: true
        });

        $('.fecha').keydown(function() {
            //code to not allow any changes to be made to input field
            return false;
        });

        $(document).ready(function () {

            var titular = "{{ $titular }}";
            var difunto = "{{ $difunto }}";
            var dni = "{{ $dni }}";
            var calle = "{{ $calle }}";
            var desde = "{{ $desde }}";
            var hasta = "{{ $hasta }}";
            var search = "{{ (isset($search))?$search:0 }}";

            $(document).on('click','.pagination a', function(e){

                e.preventDefault();

                var page = $(this).attr('href').split('page=')[1];

                var url;
                var data;
                if(search == 1){

                    url = "{{ URL::route('busquedaFacturas') }}";
                    data = {page: page, titular: titular, difunto:difunto, dni:dni, calle:calle, desde:desde, hasta:hasta};
                } else{
                    url = '/ajax/facturas';
                    data ={page :page};
                }

                $.ajax({

                    type: "POST",
                    url: url,
                    data:data,
                    success: function(data){ $('.render').html(data); }

                })
            });
        });






    </script>
@endsection



