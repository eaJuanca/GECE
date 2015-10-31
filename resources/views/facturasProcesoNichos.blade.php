@extends('master')

@section('title') <h2 style="color: white; font-weight: bold; margin-left:10px; "> Facturas Rápidas </h2>

<p class="pull-right"><a href="{{ URL::route('home') }}" class="btn btn-md btn-material-orange back glyphicon glyphicon glyphicon-arrow-left"></a></p>

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

                    @if($factura)
                       <a href="{{ route('pdfacturanicho',[$factura])}}"> <button class="btn btn-danger">Factura cesión</button> </a>
                        @endif
                </div>
            </div>

        </div>
    </div>


@endsection

@section('jquery')


@endsection
