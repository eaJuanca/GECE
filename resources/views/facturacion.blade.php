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
            <h3 class="panel-title" style="color: white">Facturación</h3>
        </div>
        <div class="panel-body">
            <form method="POST" action="{{URL::route('busquedaNichos')}}">

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

                            <div  id="dnibuscar" class="col col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Dni</label>
                                    <input type="text" class="form-control" name="dni" value="<?php if(isset($dni)) echo $dni; else $dni=''; ?>">
                                </div>
                            </div>

                            <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Nombre de calle</label>
                                    <input type="text" class="form-control" name="calle" value="<?php if(isset($calle)) echo $calle;  else $calle='';?>">
                                </div>
                            </div>

                            <div class="col col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Número de calle</label>
                                    <input type="text" class="form-control" name="numero" value="<?php if(isset($numero)) echo $numero; else $numero=''; ?>">
                                </div>
                            </div>

                            <div class="col col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputWarning">Tramada</label>
                                    <input type="text" class="form-control"  name="tramada" value="<?php if(isset($tramada)) echo $tramada; else $tramada=''; ?>">
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col col-lg-10 col-md-10 col-sm-12 col-xs-12" style="margin-top: 20px">

                                <span id='search' style="font-weight: bold; font-size:16px; visibility: hidden; ">A continuación se muestran los resultados de búsqueda. Pulse <a  href="{{URL::route('nichos')}}" class="btn btn-danger btn-raised btn-xs" style="letter-spacing: 3px">Terminar</a> para finalizar</span>

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

@endsection

@section('js')
@endsection



