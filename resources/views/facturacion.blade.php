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

                        <input type="hidden"  id="activa" name="activa" value="1">
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

                            <div class="col col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Fecha desde</label>
                                    <input type="text" class="form-control" name="desde" value="<?php if(isset($desde)) echo $desde; else $desde=''; ?>">
                                </div>
                            </div>

                            <div class="col col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Fecha hasta</label>
                                    <input type="text" class="form-control"  name="hasta" value="<?php if(isset($hasta)) echo $hasta; else $hasta=''; ?>">
                                </div>
                            </div>


                            <div class="col col-lg-2 col-md-2 col-sm-12 col-xs-12 pull-right">
                                <div class="form-group">
                                    <br>
                                    <button type="submit" class="btn btn-primary btn-raised">Buscar</button>
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

                        <table class="table table-bordered table-hover" cellspacing="10" cellpadding="10">
                            <thead>
                            <tr>
                                <th>Cod.</th>
                                <th>Tipo</th>
                                <th>Otra</th>

                            </tr>
                            </thead>
                            <tbody class="tfacturas">

                            @foreach($facturas as $factura)

                                <tr>
                                    <td> {{$factura->id}}</td>
                                    <td> {{$factura->idtitular}}</td>
                                    <td> <a onclick="alert({{ $factura->id }})"> alert</a></td>


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

        $(document).ready(function () {

            $(document).on('click','.pagination a', function(e){

                e.preventDefault();

                var page = $(this).attr('href').split('page=')[1];
                getFacturas(page);
            });


        });

        function getFacturas (page){

            $.ajax({

                type: "POST",
                url: '/ajax/facturas',
                data:{page :page}

            }).done(function(data){

                $('.render').html(data);

            });
        }




    </script>
@endsection



